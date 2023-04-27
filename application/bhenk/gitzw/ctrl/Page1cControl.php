<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;

abstract class Page1cControl extends PageControl {

    public function renderPage(): void {
        $this->addStylesheet("/css/base/1cp.css");
        require_once Env::templatesDir() . "/base/1cp.php";
    }

    public function renderBody(): void {
        echo "body";
    }
}