<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\site\Request;

class Handler extends AbstractHandler {

    public function handle(): void {
        $this->handleRequest(new Request());
    }

    public function handleRequest(Request $request): void {
        $this
            ->setNextHandler(new AuthHandler())
            ->setNextHandler(new CreatorHandler())
            ->setNextHandler(new WorkHandler())
            ->setNextHandler(new NotFoundHandler());

        $this->getNextHandler()->handleRequest($request);
    }
}