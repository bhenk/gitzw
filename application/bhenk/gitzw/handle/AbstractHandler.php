<?php

namespace bhenk\gitzw\handle;

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