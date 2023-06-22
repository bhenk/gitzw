<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrl\ErrorControl;
use bhenk\gitzw\ctrla\AdminControl;
use bhenk\gitzw\ctrla\DeployControl;
use bhenk\gitzw\ctrla\FileExplorerControl;
use bhenk\gitzw\ctrla\ImageControl;
use bhenk\gitzw\ctrla\PhpInfoControl;
use bhenk\gitzw\ctrla\RepsControl;
use bhenk\gitzw\ctrla\StoreControl;
use bhenk\gitzw\ctrla\UploadControl;
use bhenk\gitzw\ctrla\WorkControl;
use bhenk\gitzw\ctrla\WorksControl;
use bhenk\gitzw\site\Request;
use Exception;
use PHPUnit\Event\Code\Throwable;

class AdminHandler extends AbstractHandler {

    public function handleRequest(Request $request): void {
        $act = $request->getUrlPart(1);
        $ctrl = match ($act) {
            "upload" => new UploadControl($request),
            "explore" => new FileExplorerControl($request),
            "image" => new ImageControl($request),
            "reps" => new RepsControl($request),
            "work" => new WorkControl($request),
            "works" => new WorksControl($request),
            "phpinfo" => new PhpInfoControl($request),
            "deploy" => new DeployControl($request),
            "store" => new StoreControl($request),
            "error_page" => (new ErrorControl($request))->setError(new Exception("TestError", 200)),
            default => new AdminControl($request),
        };
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

}