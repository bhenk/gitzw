<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrl\WorkPageControl;
use bhenk\logger\log\Req;
use function explode;
use function parse_url;
use function preg_replace;
use function substr;

class Gitzwart {

    public function handleRequestURI(): void {
        Req::info("");
        $path = preg_replace("/[^0-9a-zA-Z\/._ +]/", "-",
            parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        //echo $path . "<br/>";
        $this->handleRequest(explode('/', substr($path, 1)));
    }

    public function handleRequest(array $path): void {
        switch($path[0]) {
            case "":
                echo "<h1>Home Page</h1>";
                foreach ($_SERVER as $key => $value) {
                    if ($key != "argv") echo "$key = '$value'<br/>";
                }
                return;
            case "gendan":
                echo "<h1>Client IP</h1>";
                echo $this->clientIp() . "<br/>";
                return;
        }
        $second = $path[1] ?? "";
        if ($second == "work") {
            if ((new WorkPageControl())->renderPage($path)) return;
        }
        $maybeId = explode(".", $path[0]);
        $second = $maybeId[1] ?? "";
        if ($second == "work") {
            if ((new WorkPageControl())->renderPage($maybeId, true)) return;
        }

        echo "<h1>404</h1>";
        echo "Not found: " . $_SERVER["REQUEST_URI"];
    }

    private function clientIp() : string {
        $ip_address = '0.0.0.0';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        return  $ip_address;
    }

}