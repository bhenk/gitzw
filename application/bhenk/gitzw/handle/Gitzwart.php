<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Security;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\CreatorPageControl;
use bhenk\gitzw\ctrl\LoginPageControl;
use bhenk\gitzw\ctrl\WorkPageControl;
use bhenk\gitzw\ctrla\AdminPageControl;
use bhenk\logger\log\Log;
use bhenk\logger\log\Req;
use Exception;
use Throwable;
use function explode;
use function is_null;
use function parse_url;
use function preg_replace;
use function session_start;
use function strtolower;
use function substr;

class Gitzwart {

    /**
     * Handle a raw request
     *
     * @return void
     * @throws Exception
     */
    public function handleRequestURI(): void {
        try {
            $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
            Log::info("------------------- request: " . $path);
            Req::info("");
            $path = strtolower(preg_replace("/[^0-9a-zA-Z\/._ +]/", "-", $path));
            $path_array = explode('/', substr($path, 1));
            session_start();
            if (isset($_SESSION["logged_in"]) and $_SESSION["logged_in"]) {
                if (Site::isRestricted($path_array)) {
                    if (Security::get()->sessionExpired($path)) return;
                }
            }
            $this->handleRequest($path_array);
        } catch (Throwable $e) {
            echo "<h1>500 from handleRequestURI</h1>";
            do {
                echo "message:<br/>" . $e->getMessage();
                $e = $e->getPrevious();
            } while (!is_null($e));
        }
    }

    /**
     * Handle a processed request
     *
     * @param array $path_array
     * @return void
     * @throws Exception
     */
    public function handleRequest(array $path_array): void {
        switch (count($path_array)) {
            case 1:
                if ($this->handlePath1($path_array[0])) return;
                break;
            case 5:
                if ($this->handlePath5($path_array)) return;
                break;
        }
        switch ($path_array[0]) {
            case "admin":
                if ((new AdminHandler())->canHandle($path_array)) return;
                break;
            case "foo":
                return;
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
            case "logout":
                if ((new LoginPageControl())->canHandle($path)) return true;
                break;
        }
        if ((new WorkPageControl())->canHandle($path)) return true;
        if ((new CreatorPageControl())->canHandle($path)) return true;
        return false;
    }

    /**
     * @param array $path_array
     * @return bool
     * @throws Exception
     */
    private function handlePath5(array $path_array): bool {
        $second = $path_array[1];
        if ($second == "work") {
            if ((new WorkPageControl())->canHandle($path_array)) return true;
        }
        return false;
    }

}