<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function array_keys;
use function array_values;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

#[LogAttribute(false)]
class CreatorDaoTest extends TestCaseRo {

    public function testCountWhere() {
        $dao = Dao::creatorDao();
        self::assertEquals(1, $dao->countWhere("1=1"));
    }

    public function testCounts() {
        $counts = Dao::countWhere();
        //var_dump($counts);
        assertEquals(6, count($counts));
    }

    public function testAnalyze() {
        $result = Dao::workDao()->analyze();
        //var_dump($result);
        assertEquals("gitzw.tbl_works", $result[0]["Table"]);
        assertEquals("analyze", $result[0]["Op"]);
        assertEquals("status", $result[0]["Msg_type"]);
//        echo "\n";
//        foreach (array_keys($result[0]) as $key) {
//            echo $key . ";";
//        }
//        echo "\n";
//        foreach (array_values($result[0]) as $value) {
//            echo $value . ";";
//        }
    }

    public function testAnalyzeTables() {
        $result = Dao::analyzeTables();
        //var_dump($result);
        assertEquals(6, count($result));
    }

}
