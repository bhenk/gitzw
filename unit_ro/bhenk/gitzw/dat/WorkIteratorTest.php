<?php

namespace bhenk\gitzw\dat;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function PHPUnit\Framework\assertEquals;

#[LogAttribute(false)]
class WorkIteratorTest extends TestCaseRo {

    public function testIterator() {
        $iter = new WorkIterator();
        assertEquals(0, $iter->getCount());
        $count = 0;
        while ($iter->hasNext()) {
            $work = $iter->next();
            $count++;
            assertEquals($count, $iter->getCount());
        }
        assertEquals($iter->getCount(), $count);
    }

}
