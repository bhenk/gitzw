<?php

use bhenk\gitzw\handle\Gitzwart;

$root = dirname(__DIR__);
require_once $root . "/vendor/autoload.php";
date_default_timezone_set('Europe/Amsterdam');

(new Gitzwart())->handleRequestURI();
