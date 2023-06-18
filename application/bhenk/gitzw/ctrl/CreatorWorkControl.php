<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dat\Creator;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;

class CreatorWorkControl extends Page1cControl {

    private Creator $creator;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->creator = $request->getCreator();
        $this->addStylesheet("/css/home/creator_work.css");
        $request->setUseCache(true);
    }

    public function handleRequest(): void {
        $this->setPageTitle($this->creator->getFullName());
    }

    function renderContainer(): void {
        require_once Env::templatesDir() . "/home/creator_work.php";
    }

    public function getCreator(): Creator {
        return $this->creator;
    }

    public function getData(): array {
        $data = [];
        $categories = [WorkCategories::paint, WorkCategories::draw, WorkCategories::dry];
        foreach ($categories as $cat) {
            $data[$cat->name] = $this->getCreator()->getImageData($cat, 400, 0, 200);
        }
        return $data;
    }
}