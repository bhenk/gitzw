<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\base\Images;
use bhenk\TestCaseRo;

class RepresentationIteratorTest extends TestCaseRo {

    public function testImages() {
        $iter = new RepresentationIterator();
        while ($iter->hasNext()) {
            $repr = $iter->next();
            Images::createImages($repr->getREPID());
        }
        self::assertEquals(1, 1);
    }

    public function testStrange() {
//        $repid = "hnq/1979/diabolo_01.jpg";
//        Images::createImages($repid);
        self::assertEquals(1, 1);
    }

}
