<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\model\WorkCategories;
use Exception;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertStringStartsWith;

class RoWorkStoreTest extends TestCase {

    /**
     * @throws Exception
     */
    public function testSelectRESIDsWhere() {
        $results = Store::workStore()->selectRESIDsWhere(2020, WorkCategories::draw);
        assertStringStartsWith("hnq.work.draw.2020.", $results[0]);
    }

}
