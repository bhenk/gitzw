<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\model\WorkCategories;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use Exception;
use function PHPUnit\Framework\assertEquals;

#[LogAttribute(false)]
class RoStoreTest extends TestCaseRo {

    /**
     * @throws Exception
     */
    public function testNextRESID() {
        assertEquals("hnq.work.draw.3030.0000",
            Store::nextRESID(1, WorkCategories::draw, 3030));

        assertEquals("hnq.work.paint.2020.0027",
            Store::nextRESID(1, WorkCategories::paint, 2020));
    }

    /**
     * @throws Exception
     */
    public function testNextEXHID() {
        assertEquals("gitzw.exh.2020.0000", Store::nextEXHID(2020));
    }
}
