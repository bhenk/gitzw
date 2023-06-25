<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\daf\RepFilter;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use function in_array;
use function intval;
use function strlen;

class RepExplorerControl extends Page3cControl {

    private RepFilter $repFilter;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/reps.css");
        $this->setPageTitle("Explore Representations");
        $this->repFilter = new RepFilter();
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
        require_once Env::templatesDir() . "/admin/reps/overview.php";
    }

    public function getCountByYear(): array {
        return Store::representationStore()->countByYear();
    }

    public function getCountBySource(): array {
        return Store::representationStore()->countBySource();
    }

    public function getFilter(): RepFilter {
        return $this->repFilter;
    }


}