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
            $name = $request->getIdPart(0);
            if (empty($name)) {
                $this->getNextHandler()->handleRequest($request);
                return;
            } else {
                $creator = Store::creatorStore()->selectByName($name);
                if (!$creator) {
                    $this->getNextHandler()->handleRequest($request);
                    return;
                } else {
                    $request->setIdUrl(true);
                }
            }
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
        $canonical = $request->getCreator()->getUriName();
        if ($request->getCleanUrl() != $canonical) {
            Site::redirect("/" . $canonical);
        } else {
            $ctrl = new CreatorPageControl($request);
            $ctrl->handleRequest();
            $ctrl->renderPage();
        }
    }
}