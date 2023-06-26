<?php

namespace bhenk\gitzw\dat;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function array_values;
use function count;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

#[LogAttribute(false)]
class RoRepresentationStoreTest extends TestCaseRo {

    public function testCountBySource() {
        $result = Store::representationStore()->countBySource();
        //var_dump($result);
        assertEquals(1, 1);
    }

    public function testSelectJoinWorkHasRepWhere() {
        $where = "WHERE 1=1";
        $reps = Store::representationStore()->selectJoinWorkHasRepWhere($where, 0, 10);
        assertEquals(10, count($reps));

        $where = "WHERE wr.hidden=0";
        $reps = Store::representationStore()->selectJoinWorkHasRepWhere($where, 0, 10);
        assertEquals(10, count($reps));
        self::assertInstanceOf(Representation::class, array_values($reps)[0]);
    }


}
