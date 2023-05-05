<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\base\Images;
use bhenk\TestCaseRo;
use function PHPUnit\Framework\assertEquals;

class RoRepresentationStoreTest extends TestCaseRo {

    public function testFiles() {
        $representations = Store::representationStore()
            ->orderByYear("1=1", 0, 10, true );
        foreach ($representations as $representation) {
            Images::locationForREPID($representation->getREPID(), Images::SMALLER);
        }
        assertEquals(1, 1);
    }

}
