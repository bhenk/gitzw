<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\model\WorkCategories;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use Exception;
use function PHPUnit\Framework\assertStringStartsWith;

#[LogAttribute(false)]
class RoWorkStoreTest extends TestCaseRo {

    /**
     * @throws Exception
     */
    public function testSelectRESIDsWhere() {
        $results = Store::workStore()->selectRESIDsWhere(2020, WorkCategories::draw);
        assertStringStartsWith("hnq.work.draw.2020.", $results[0]);
    }

}
