<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use function array_values;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertStringContainsString;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class ResourceDaoTest extends TestCase {
    use ConsoleLoggerTrait;

    /**
     * @throws ReflectionException
     */
    #[LogAttribute(false)]
    public function testCreateTable() {
        $dao = new WorkDao();
        $sql = $dao->getCreateTableStatement();
        assertStringContainsString("tbl_works", $sql);
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    #[LogAttribute(true)]
    public function testInsert() {
        $dao = new WorkDao();
        $result = $dao->createTable(true);
        assertTrue($result >= 1);
        $rid = new WorkDo(null,
            "hnq.work.paint.2020.0000",
            "A new work",
            "Een nieuw werk",
            "en",
            "mixed",
            20.42,
            42.3,
            -1,
            "1978-01-01",
            "YYYY",
            false,
            5,
            "paint"
        );
        $dao = new WorkDao();
        $rid2 = $dao->insert($rid);
        assertTrue($rid->equals($rid2));
        $selected = $dao->selectWhere("RESID='hnq.work.paint.2020.0000'");
        assertEquals(1, count($selected));
        assertIsArray($selected);
        $rid3 = array_values($selected)[0];
        assertTrue($rid2->isSame($rid3));
    }

}
