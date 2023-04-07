<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class ResRepDaoTest extends TestCase {
    use ConsoleLoggerTrait;

    /**
     * @throws ReflectionException
     */
    public function testCreateTable() {
        $dao = new ResRepDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
    }

    /**
     * @throws Exception
     */
    public function testInsert() {
        $dao = new ResRepDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
        $do = new ResRepDo(null,
            1,
            1,
            6,
            true,
            false);
        $dao = new ResRepDao();
        $do2 = $dao->insert($do);
        assertTrue($do->equals($do2));
        $selected = $dao->selectWhere("representationID=1");
        assertEquals(1, count($selected));
        assertIsArray($selected);
        $do3 = $selected[0];
        assertTrue($do2->isSame($do3));
    }

}
