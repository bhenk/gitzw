<?php

namespace bhenk\gitzw\dat;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function count;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

#[LogAttribute(true)]
class RoRepresentationStoreTest extends TestCaseRo {

    public function testCountBySource() {
        $result = Store::representationStore()->countBySource();
        //var_dump($result);
        assertEquals(1, 1);
    }

    public function testGetREPIDsByFilter() {
        $s = "NOT (r.source='OpticFilm 8200i' OR r.source='MP250 series')";
        $h = false;
        $c = 0;
        $result = Store::representationStore()->getREPIDsByFilter($s, $h, $c, 10);
        //var_dump($result);
        assertEquals(1, 1);
    }

}
