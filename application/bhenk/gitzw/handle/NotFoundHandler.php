<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\site\Request;

class NotFoundHandler extends AbstractHandler {


    public function handleRequest(Request $request): void {
        echo "<h1>Not Found</h1>";
        echo "Unknown resource indicated by the url " . $request->getRawUrl() . "<br/>";
        if ($request->hasSessionUser()) {
            echo "sessionUser: " . $request->getSessionUser()->getFullName() . "<br/>";
        }
        if ($request->hasCreator()) {
            echo "creator: " . $request->getCreator()->getFullName() . "<br/>";
        }
        if ($request->hasWork()) {
            echo "work: " . $request->getWork()->getCanonicalUrl() . "<br/>";
        }

    }
}