<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\site\Request;

abstract class AbstractHandler implements HandlerInterface {

    private ?HandlerInterface $nextHandler = null;

    public function setNextHandler(HandlerInterface $next): HandlerInterface {
        $this->nextHandler = $next;
        return $next;
    }

    /**
     * @return HandlerInterface|null
     */
    public function getNextHandler(): ?HandlerInterface {
        return $this->nextHandler;
    }
}