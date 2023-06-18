<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\site\Request;
use function file_get_contents;
use function str_replace;

class HomePageControl extends Page1cControl {

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/home/home.css");
    }
    public function handleRequest(): void {
        $this->setPageTitle("GITZW.ART");
        $this->setStructuredData($this->readStructuredData());
    }

    public function renderContainer(): void {
        require_once Env::templatesDir() ."/home/home.php";
    }

    private function readStructuredData(): string {
        return str_replace(['{version}', '{datePublished}'],
            [Env::version(), Env::versionDate()], file_get_contents(Env::dataDir() . '/sd/home.json'));
    }
}