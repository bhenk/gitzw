<?php

namespace bhenk\gitzw\model;

interface DimensionsInterface {

    public function setWidth(float $width): void;

    public function getWidth(): float;

    public function setHeight(float $height): void;

    public function getHeight(): float;

    public function setDepth(float $depth): void;

    public function getDepth(): float;

}