<?php

namespace bhenk\gitzw\ctrl;

use function header;
use function implode;
use function is_array;
use function strlen;
use function substr;

class Site {

    public static function hostName() : string {
        if (isset($_SERVER['HTTP_HOST'])) {
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
                .'://'.$_SERVER['HTTP_HOST'];
        } else {
            return 'http://no_host';
        }
    }

    public static function redirectLocation($path) : string {
        if (is_array($path)) {
            $path = implode('/', $path);
        }
        if (str_ends_with($path, '/')) {
            $path = substr($path, 0, strlen($path) - 1);
        }
        if (!(str_starts_with($path, '/'))) {
            $path = '/'.$path;
        }
        if ($path === '/') {
            $path = '';
        }
        return self::hostName().$path;
    }

    public static function redirect($path) : string {
        $location = self::redirectLocation($path);
        header("Location: ".$location, TRUE, 301);
        return $location;
    }

}