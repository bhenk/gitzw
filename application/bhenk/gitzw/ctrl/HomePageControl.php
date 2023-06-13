<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\site\Request;

class HomePageControl extends Page1cControl {

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/home/home.css");
    }
    public function handleRequest(): void {
        $this->setPageTitle("GITZW.ART");
    }

    public function renderContainer(): void {
        require_once Env::templatesDir() ."/home/home.php";
    }
}