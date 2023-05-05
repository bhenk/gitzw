<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\CreatorPageControl;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;

class CreatorHandler extends AbstractHandler {

    public function handleRequest(Request $request): void {
        $name = $request->getUrlPart(0);
        $creator = Store::creatorStore()->selectByName($name);
        if (!$creator) {
            $this->getNextHandler()->handleRequest($request);
            return;
        }
        $request->setCreator($creator);
        $act = $request->getUrlPart(1);
        if ($act != "") {
            $this->getNextHandler()->handleRequest($request);
            return;
        }
        $this->goCreatorPage($request);
    }

    private function goCreatorPage(Request $request): void {
        $long_url = $request->getCreator()->getUriName();
        if ($request->getUrlPart(0) != $long_url) {
            Site::redirect("/" . $long_url);
        } else {
            $ctrl = new CreatorPageControl($request);
            $ctrl->handleRequest();
            $ctrl->renderPage();
        }
    }
}