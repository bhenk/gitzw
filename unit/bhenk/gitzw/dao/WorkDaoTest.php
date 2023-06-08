<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use ReflectionException;
use function array_values;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertIsArray;
use function PHPUnit\Framework\assertStringContainsString;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(true)]
class WorkDaoTest extends TestCaseDb {

    /**
     * @throws ReflectionException
     */
    #[LogAttribute(false)]
    public function testCreateTable() {
        $dao = new WorkDao();
        $sql = $dao->getCreateTableStatement();
        assertStringContainsString("tbl_works", $sql);
        $result = $dao->createTable();
        assertTrue($result >= 1);
    }

    /**
     * @throws Exception
     */
    #[LogAttribute(true)]
    public function testInsert() {
        $do = new WorkDo(null,
            "hnq.work.paint.2020.0000",
            "A new work",
            "Een nieuw werk",
            "en",
            "mixed",
            20.42,
            42.3,
            -1,
            "2 panels, 20 x 40 cm. each",
            "1978-01-01",
            "YYYY",
            false,
            5,
            "paint",
        null,
        null,
        null,
        42

        );
        $do2 = Dao::workDao()->insert($do);
        assertTrue($do->equals($do2));
        $selected = Dao::workDao()->selectWhere("RESID='hnq.work.paint.2020.0000'");
        assertEquals(1, count($selected));
        assertIsArray($selected);
        $do3 = array_values($selected)[0];
        assertTrue($do2->isSame($do3));
    }

}
