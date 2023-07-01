<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function PHPUnit\Framework\assertEquals;

#[LogAttribute(false)]
class RoWorkDaoTest extends TestCaseRo {

    public function testSelectBatch() {
        $result = Dao::workDao()->selectBatch([1, 2, 3]);
        assertEquals(3, count($result));
    }

}
