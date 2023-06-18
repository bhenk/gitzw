<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\CreatorWorkControl;
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
        $act1 = $request->getUrlPart(1);
        if ($act1 == "") {
            $this->goCreatorPage($request);
            return;
        } elseif ($act1 == "work") {
            $act2 = $request->getUrlPart(2);
            if ($act2 == "") {
                $this->goCreatorWorkPage($request);
                return;
            }
        }
        $this->getNextHandler()->handleRequest($request);
    }

    private function goCreatorPage(Request $request): void {
        $canonical = $request->getCreator()->getUriName();
        if ($request->getCleanUrl() != $canonical) {
            Site::redirect("/" . $canonical);
        } else {
            // voorlopig
            $ctrl = new CreatorWorkControl($request);
            $ctrl->handleRequest();
            $ctrl->renderPage();
        }
    }

    private function goCreatorWorkPage(Request $request): void {
        $canonical = $request->getCreator()->getUriName() . "/work";
        if ($request->getCleanUrl() != $canonical) {
            Site::redirect("/" . $canonical);
        } else {
            $ctrl = new CreatorWorkControl($request);
            $ctrl->handleRequest();
            $ctrl->renderPage();
        }
    }
}