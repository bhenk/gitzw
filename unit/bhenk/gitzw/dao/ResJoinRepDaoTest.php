<?php

namespace bhenk\gitzw\dao;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class ResJoinRepDaoTest extends TestCase {

    /**
     * @throws ReflectionException
     */
    public function testCreateTable() {
        $dao = Dao::workHasRepDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
    }

    public function testTempAware() {
        $dao = Dao::workHasRepDao();
        assertEquals(WorkHasRepDao::TABLE_NAME, $dao->getTableName());

        $dao->setTemp(true);
        assertEquals(WorkHasRepDao::TABLE_NAME . "_temp", $dao->getTableName());
    }

}
