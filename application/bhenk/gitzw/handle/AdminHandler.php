<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrl\ErrorControl;
use bhenk\gitzw\ctrla\AdminControl;
use bhenk\gitzw\ctrla\DeployControl;
use bhenk\gitzw\ctrla\FileExplorerControl;
use bhenk\gitzw\ctrla\RepEditControl;
use bhenk\gitzw\ctrla\PhpInfoControl;
use bhenk\gitzw\ctrla\RepExplorerControl;
use bhenk\gitzw\ctrla\StoreControl;
use bhenk\gitzw\ctrla\FileUploadControl;
use bhenk\gitzw\ctrla\WorkControl;
use bhenk\gitzw\ctrla\WorksControl;
use bhenk\gitzw\site\Request;
use Exception;
use PHPUnit\Event\Code\Throwable;

class AdminHandler extends AbstractHandler {

    public function handleRequest(Request $request): void {
        $act = $request->getUrlPart(1);
        match ($act) {
            "file" => $this->handleFileRequest($request),
            "representation" => $this->handleRepresentationRequest($request),
            default => $this->handleOldStyle($request)
        };
    }

    private function handleOldStyle(Request $request): void {
        echo "old style " . self::class;
        $act = $request->getUrlPart(1);
        $ctrl = match ($act) {
            "upload" => new FileUploadControl($request),
            "explore" => new FileExplorerControl($request),
            "image" => new RepEditControl($request),
            "reps" => new RepExplorerControl($request),
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

    private function handleAdminRequest(Request $request): void {
        $ctrl = new AdminControl($request);
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

    private function handleFileRequest(Request $request): void {
        $act = $request->getUrlPart(2);
        $ctrl = match ($act) {
            "upload" => new FileUploadControl($request),
            "explore" => new FileExplorerControl($request),
            default => new AdminControl($request)
        };
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

    private function handleRepresentationRequest(Request $request): void {
        $act = $request->getUrlPart(2);
        $ctrl = match ($act) {
            "explore" => new RepExplorerControl($request),
            "edit" => new RepEditControl($request),
            default => new AdminControl($request)
        };
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

}