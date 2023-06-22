<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;

class RepsControl extends Page3cControl {

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/reps.css");
        $this->setPageTitle("Explore Representations");
    }
    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        require_once Env::templatesDir() . "/admin/reps/explore.php";
    }

    public function getCountByYear(): array {
        return Store::representationStore()->countByYear();
    }
}