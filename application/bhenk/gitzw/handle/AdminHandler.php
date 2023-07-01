<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrl\ErrorControl;
use bhenk\gitzw\ctrla\AdminControl;
use bhenk\gitzw\ctrla\DeployControl;
use bhenk\gitzw\ctrla\FileExplorerControl;
use bhenk\gitzw\ctrla\FileUploadControl;
use bhenk\gitzw\ctrla\PhpInfoControl;
use bhenk\gitzw\ctrla\RepEditControl;
use bhenk\gitzw\ctrla\RepExplorerControl;
use bhenk\gitzw\ctrla\StoreControl;
use bhenk\gitzw\ctrla\WorkControl;
use bhenk\gitzw\site\Request;
use Exception;

class AdminHandler extends AbstractHandler {

    public function handleRequest(Request $request): void {
        $act = $request->getUrlPart(1);
        match ($act) {
            "file" => $this->handleFileRequest($request),
            "representation" => $this->handleRepresentationRequest($request),
            "work" => $this->handleWorkRequest($request),
            "system" => $this->handleSystemRequest($request),
            default => $this->handleAdminRequest($request)
        };
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

    private function handleWorkRequest(Request $request): void {
        $act = $request->getUrlPart(2);
        $ctrl = match ($act) {
            "new", "create", "edit" => new WorkControl($request), // modes: new, create, edit
            default => new AdminControl($request)
        };
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

    private function handleSystemRequest(Request $request): void {
        $act = $request->getUrlPart(2);
        $ctrl = match ($act) {
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