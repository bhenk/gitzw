<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\ctrl\NotFoundControl;
use bhenk\gitzw\site\Request;

class NotFoundHandler extends AbstractHandler {


    public function handleRequest(Request $request): void {
        $ctrl = new NotFoundControl($request);
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }


}