<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use bhenk\msdata\connector\MysqlConnector;
use Throwable;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function is_null;
use function ob_start;
use function session_start;
use function str_replace;
use function strpos;
use function substr_replace;

class Handler extends AbstractHandler {

    private bool $compiled = false;
    private Request $request;

    public function handle(): void {
        try {
            $this->handleRequest(new Request());
        } catch (Throwable $e) {
            Log::error("Caught exception while serving request: " . $_SERVER["REQUEST_URI"],
                [$_SERVER, $e]);
            echo "<h1>potsblitz</h1> Caught exception while serving request: " . $_SERVER["REQUEST_URI"];
            do {
                echo "<h2>" . $e::class . "</h2>" . $e->getMessage();
                echo $e->getFile() . ":" . $e->getLine() . "<br/>"
                    . str_replace("\n", "<br/>", $e->getTraceAsString());
                $e = $e->getPrevious();
            } while (!is_null($e));
            echo "<h2>SERVER values</h2>";
            foreach($_SERVER as $key => $value) {
                if ($key != "argv") echo $key . " = " . $value;
                echo "<br/>";
            }
        } finally {
            if ($this->compiled) MysqlConnector::closeConnection();
        }
    }

    public function handleRequest(Request $request): void {
        $this->request = $request;
        session_start();
        if ($this->request->getUrlPart(0) == "ajax") {
            (new AjaxResponse())->handle($this->request);
            return;
        }
        if (Env::useCache()) {
            $cache_filename = $this->request->getCacheFilename();
            if (file_exists($cache_filename)) {
                Log::info("Serving from cache");
                echo file_get_contents($cache_filename);
                return;
            }
        }
        ob_start([$this, 'saveOutput']);
        $this->compiled = true;
        $this
            ->setNextHandler(new AuthHandler())
            ->setNextHandler(new CreatorHandler())
            ->setNextHandler(new WorkHandler())
            ->setNextHandler(new NotFoundHandler());

        $this->getNextHandler()->handleRequest($this->request);
    }

    public function saveOutput(string $buffer): string {
        if (!$this->request->useCache()) return $this->addStructuredData($buffer);

        $buffer = $this->sanitize_output($buffer);
        $buffer = $this->addStructuredData($buffer);
        $cache_filename = $this->request->getCacheFilename();
        file_put_contents($cache_filename, $buffer);
        Log::notice("++++++++ saved cache: " . $cache_filename);
        return $buffer;
    }

    private function sanitize_output($buffer): string {

        $search = array(
            '/>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        return preg_replace($search, $replace, $buffer);
    }

    private function addStructuredData(string $buffer): string {
        $sd = $this->request->getStructuredData();
        if (!is_null($sd)) {
            $pos = strpos($buffer, '</head>');
            $buffer = substr_replace($buffer, $sd, $pos, 0);
        }
        return $buffer;
    }
}