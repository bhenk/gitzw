<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\site\Request;

class NotFoundHandler extends AbstractHandler {


    public function handleRequest(Request $request): void {
        echo "<h1>Not Found</h1>";
        echo "Unknown resource indicated by the url " . $request->getRawUrl();

    }
}