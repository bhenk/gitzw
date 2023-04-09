<?php

namespace bhenk\gitzw\dao;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use function PHPUnit\Framework\assertTrue;

class ResJoinRepDaoTest extends TestCase {

    /**
     * @throws ReflectionException
     */
    public function testCreateTable() {
        $dao = Dao::resJoinRepDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
    }

}
