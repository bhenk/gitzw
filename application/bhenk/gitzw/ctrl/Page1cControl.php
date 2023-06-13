<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;

abstract class Page1cControl extends PageControl {


    public function renderPage(): void {
        $this->addStylesheet("/css/base/base.css");
        require_once Env::templatesDir() . "/base/1cp.php";
    }

    abstract function renderContainer(): void;
}