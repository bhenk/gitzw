<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrla\AdminControl;
use bhenk\gitzw\ctrla\FileExplorerControl;
use bhenk\gitzw\ctrla\ImageControl;
use bhenk\gitzw\ctrla\RepresentationsPageControl;
use bhenk\gitzw\ctrla\SystemControl;
use bhenk\gitzw\ctrla\UploadControl;
use bhenk\gitzw\ctrla\WorkControl;
use bhenk\gitzw\site\Request;

class AdminHandler extends AbstractHandler {

    public function handleRequest(Request $request): void {
        $act = $request->getUrlPart(1);
        $ctrl = match ($act) {
            "upload" => new UploadControl($request),
            "explore" => new FileExplorerControl($request),
            "image" => new ImageControl($request),
            "work" => new WorkControl($request),
            "system" => new SystemControl($request),
            "representations" => new RepresentationsPageControl($request),
            default => new AdminControl($request),
        };
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

}