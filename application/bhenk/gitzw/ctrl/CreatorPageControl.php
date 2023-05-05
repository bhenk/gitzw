<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\dat\Creator;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use Exception;

class CreatorPageControl extends Page3cControl {

    private Creator $creator;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->creator = $request->getCreator();
    }

    public function handleRequest(): void {
        $this->setPageTitle($this->creator->getFullName());

    }

    public function renderColumn2(): void {

        echo "<h1>" . self::class . "</h1>";
        echo "<h2>" . $this->creator->getCRID() . "</h2>";
        echo $this->creator->getFullName();
    }


}