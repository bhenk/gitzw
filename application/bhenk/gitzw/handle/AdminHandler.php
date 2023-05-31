<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrl\PageControl;
use bhenk\gitzw\ctrla\AdminPageControl;
use bhenk\gitzw\ctrla\FileExplorerControl;
use bhenk\gitzw\ctrla\SystemControl;
use bhenk\gitzw\ctrla\UploadControl;
use bhenk\gitzw\ctrla\RepresentationsPageControl;
use bhenk\gitzw\site\Request;

class AdminHandler extends AbstractHandler {

    public function handleRequest(Request $request): void {
        $act = $request->getUrlPart(1);
        $ctrl = match ($act) {
            "upload" => new UploadControl($request),
            "explore" => new FileExplorerControl($request),
            "system" => new SystemControl($request),
            "representations" => new RepresentationsPageControl($request),
            default => new AdminPageControl($request),
        };
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

}