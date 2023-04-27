<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\CreatorPageControl;
use bhenk\gitzw\ctrl\LoginPageControl;
use bhenk\gitzw\ctrl\WorkPageControl;
use bhenk\logger\log\Req;
use Exception;
use function explode;
use function parse_url;
use function preg_replace;
use function reset;
use function substr;

class Gitzwart {

    public function handleRequestURI(): void {
        Req::info("");
        $path = preg_replace("/[^0-9a-zA-Z\/._ +]/", "-",
            parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        $this->handleRequest(explode('/', substr($path, 1)));
    }

    public function handleRequest(array $path): void {
        try {
            switch (count($path)) {
                case 1:
                    if ($this->handlePath1($path[0])) return;
                    break;
                case 5:
                    if ($this->handlePath5($path)) return;
                    break;
            }
        } catch (Exception $e) {
            echo "<h1>500</h1>";
            echo "Something went wrong:<br/>" . $e->getMessage();
        }

        echo "<h1>404</h1>";
        echo "Not found: " . $_SERVER["REQUEST_URI"];
    }

    /**
     * @param string $path
     * @return bool
     * @throws Exception
     */
    private function handlePath1(string $path): bool {
        switch($path) {
            case "":
                echo "<h1>Home Page</h1>";
                foreach ($_SERVER as $key => $value) {
                    if ($key != "argv") echo "$key = '$value'<br/>";
                }
                return true;
            case "client_ip":
            case "client":
            case "client-ip":
                echo "<h1>Client IP</h1>";
                echo Site::clientIp() . "<br/>";
                return true;
            case "login":
                if ((new LoginPageControl())->canHandle($path)) return true;
        }
        $maybeId = explode(".", $path);
        $second = $maybeId[1] ?? "";
        if ($second == "work") {
            if ((new WorkPageControl())->renderPage($maybeId, true)) return true;
        }
        if ((new CreatorPageControl())->renderPage($path)) return true;
        return false;
    }

    /**
     * @param array $path
     * @return bool
     * @throws Exception
     */
    private function handlePath5(array $path): bool {
        $second = $path[1];
        if ($second == "work") {
            if ((new WorkPageControl())->renderPage($path)) return true;
        }
        return false;
    }

}