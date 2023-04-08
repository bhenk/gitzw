<?php

namespace bhenk\gitzw\dat;

use function count;
use function number_format;

abstract class AbstractStoredObject {

    public abstract function getID(): ?int;


}