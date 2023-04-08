<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use function array_values;
use function count;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class RepresentationDaoTest extends TestCase {
    use ConsoleLoggerTrait;

    /**
     * @throws ReflectionException
     */
    public function testCreateTable() {
        $dao = new RepresentationDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
    }

    /**
     * @throws Exception
     */
    public function testInsert() {
        $dao = new RepresentationDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
        $do = new RepresentationDo(null,
            "hnq/2020/_DSC0584_00001.jpg",
            "nikon",
            "in stromen vertellen (linker paneel)");
        $dao = new RepresentationDao();
        $do2 = $dao->insert($do);
        assertTrue($do->equals($do2));
        $selected = $dao->selectWhere("REPID='hnq/2020/_DSC0584_00001.jpg'");
        assertEquals(1, count($selected));
        assertIsArray($selected);
        $do3 = array_values($selected)[0];
        assertTrue($do2->isSame($do3));
    }

}
