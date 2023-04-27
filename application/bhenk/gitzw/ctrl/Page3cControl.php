<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;

abstract class Page3cControl extends PageControl {

    public function renderPage(): void {
        $this->addStylesheet("/css/3cp.css");
        require_once Env::templatesDir() . "/base/3cp.php";
    }

    public function renderHead(): void {
        echo "heading";
    }

    public function renderColumn_1(): void {
        echo "column 1";
    }

    public function renderColumn_2(): void {
        //echo "column 2 -------------------------------------------------------";
    }

    public function renderColumn_3(): void {
        echo "column 3";
    }
}