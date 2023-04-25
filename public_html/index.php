<?php

use bhenk\gitzw\handle\Gitzwart;

$root = dirname(__DIR__);
require_once $root . "/vendor/autoload.php";

(new Gitzwart())->handleRequestURI();
