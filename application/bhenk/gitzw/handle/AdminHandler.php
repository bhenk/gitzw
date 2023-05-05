<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrla\AdminPageControl;
use bhenk\gitzw\ctrla\RepresentationsPageControl;
use bhenk\gitzw\site\Request;

class AdminHandler extends AbstractHandler {

    public function handleRequest(Request $request): void {
        $act = $request->getUrlPart(1);
        $ctrl = match ($act) {
            "representations" => new RepresentationsPageControl($request),
            default => new AdminPageControl($request),
        };
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }
}