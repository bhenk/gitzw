<?php

namespace bhenk\gitzw\model;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;

class DateTraitTest extends TestCase {

    public function testFormatDate() {
        assertEquals("1998", DateUtil::rearrangeDate("1998"));
        assertEquals("1998-02", DateUtil::rearrangeDate("1998-02"));
        assertEquals("1998-02-03", DateUtil::rearrangeDate("1998-02-03"));
        assertEquals("1998-02", DateUtil::rearrangeDate("02-1998"));
        assertEquals("1998-02-03", DateUtil::rearrangeDate("03-02-1998"));

        assertEquals("2021-04-23", DateUtil::rearrangeDate("2021:04:23 10:33:59"));

        assertFalse(DateUtil::rearrangeDate("199?"));
        assertFalse(DateUtil::rearrangeDate("19999"));
    }

}
