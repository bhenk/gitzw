<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use bhenk\msdata\connector\MysqlConnector;
use Throwable;
use function implode;
use function is_null;
use function str_replace;

class Handler extends AbstractHandler {

    public function handle(): void {
        try {
            $this->handleRequest(new Request());
        } catch (Throwable $e) {
            Log::error("Caught exception while serving request: ", [$_SERVER, $e]);
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
            MysqlConnector::closeConnection();
        }
    }

    public function handleRequest(Request $request): void {
        $this
            ->setNextHandler(new AuthHandler())
            ->setNextHandler(new CreatorHandler())
            ->setNextHandler(new WorkHandler())
            ->setNextHandler(new NotFoundHandler());

        $this->getNextHandler()->handleRequest($request);
    }
}