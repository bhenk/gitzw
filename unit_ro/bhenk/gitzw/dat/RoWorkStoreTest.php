<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\model\WorkCategories;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use Exception;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertStringStartsWith;
use function var_dump;

#[LogAttribute(false)]
class RoWorkStoreTest extends TestCaseRo {

    /**
     * @throws Exception
     */
    public function testSelectRESIDsWhere() {
        $results = Store::workStore()->selectRESIDsWhere(2020, WorkCategories::draw);
        assertStringStartsWith("hnq.work.draw.2020.", $results[0]);
    }

    public function testNextRESID() {
        $result = Store::workStore()->nextRESID(42, WorkCategories::paint, "hnq");
        assertFalse($result);

        $result = Store::workStore()->nextRESID(12345, WorkCategories::paint, "hnq");
        assertFalse($result);

        $result = Store::workStore()->nextRESID("1999", WorkCategories::paint, "hnq ");
        assertFalse($result);

        $result = Store::workStore()->nextRESID("9999", WorkCategories::paint, "hnq");
        assertEquals("hnq.work.paint.9999.0000", $result);

        $result = Store::workStore()->nextRESID("2020", WorkCategories::paint, "hnq");
        assertEquals("hnq.work.paint.2020.0027", $result);
    }

    public function testGetCategories() {
        $result = Store::workStore()->getCategories("creatorId=1");
        self::assertInstanceOf(WorkCategories::class, $result[0]);
    }

}
