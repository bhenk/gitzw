<?php

namespace bhenk\gitzw\dat;

use bhenk\TestCaseRo;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

class RoRepresentationStoreTest extends TestCaseRo {

    public function testGetRepids() {
        $result = Store::representationStore()->countByYear();
        var_dump($result);
        assertEquals(1,1);
    }

}
