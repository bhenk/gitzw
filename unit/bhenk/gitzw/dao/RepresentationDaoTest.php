<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\ConsoleLoggerTrait;
use PHPUnit\Framework\TestCase;
use function count;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertTrue;

class RepresentationDaoTest extends TestCase {
    use ConsoleLoggerTrait;

    public function testCreateTable() {
        $dao = new RepresentationDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
    }

    public function testInsert() {
        $rep = new RepresentationDo(null,
        "hnq/2020/_DSC0584_00001.jpg",
        "nikon",
        "in stromen vertellen (linker paneel)");
        $dao = new RepresentationDao();
        $rep2 = $dao->insert($rep);
        assertTrue($rep->equals($rep2));
        $selected = $dao->selectWhere("REPID='hnq/2020/_DSC0584_00001.jpg'");
        assertEquals(1, count($selected));
        assertIsArray($selected);
        $rep3 = $selected[0];
        assertTrue($rep2->isSame($rep3));
    }

}
