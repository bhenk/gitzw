<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\NotFoundControl;
use bhenk\gitzw\site\Request;

class NotFoundHandler extends AbstractHandler {


    public function handleRequest(Request $request): void {
        if ($request->hasWorkCategory()) {
            $canonical = "/" . $request->getCreator()->getUriName()
                . "/work/" . $request->getWorkCategory()->value;
            Site::redirect($canonical);
        }
        if ($request->hasCreator()) {
            $canonical = "/" . $request->getCreator()->getUriName();
            Site::redirect($canonical);
        }
        $ctrl = new NotFoundControl($request);
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }


}