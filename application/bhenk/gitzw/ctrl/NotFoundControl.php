<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\site\Request;
use function header;

class NotFoundControl extends Page1cControl {

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/base/404.css");
    }

    public function handleRequest(): void {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
        $this->setPageTitle("404 at GITZW.ART");
    }

    public function renderContainer(): void {
        require_once Env::templatesDir() ."/base/404.php";
    }
}