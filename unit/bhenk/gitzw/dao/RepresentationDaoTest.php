<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use function array_values;
use function count;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class RepresentationDaoTest extends TestCaseDb {

    /**
     * @throws Exception
     */
    public function testInsert() {
        $do = new RepresentationDo(null,
            "hnq/2020/_DSC0584_00001.jpg",
            "nikon",
            "in stromen vertellen (linker paneel)");
        $do2 = Dao::representationDao()->insert($do);
        assertTrue($do->equals($do2));
        $selected = Dao::representationDao()->selectWhere("REPID='hnq/2020/_DSC0584_00001.jpg'");
        assertEquals(1, count($selected));
        assertIsArray($selected);
        $do3 = array_values($selected)[0];
        assertTrue($do2->isSame($do3));
    }

}
