<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\site\Request;

interface HandlerInterface {

    public function setNextHandler(HandlerInterface $next): HandlerInterface;

    public function getNextHandler(): ?HandlerInterface;

    public function handleRequest(Request $request): void;

}