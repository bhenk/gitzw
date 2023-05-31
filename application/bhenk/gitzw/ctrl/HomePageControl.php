<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\site\Request;

class HomePageControl extends Page3cControl {

    function __construct(Request $request) {
        $this->setIncludeCopyright(false);
        parent::__construct($request);
    }
    public function handleRequest(): void {
        $this->setPageTitle(Site::hostName());
        $this->setIncludeHeader(false);
        $this->renderPage();
    }

    public function renderColumn1(): void {
        require_once Env::templatesDir() ."/base/logo.php";
    }
}