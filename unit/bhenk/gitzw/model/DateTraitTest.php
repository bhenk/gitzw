<?php

namespace bhenk\gitzw\model;

use bhenk\gitzw\dat\Work;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;

class DateTraitTest extends TestCase {

    public function testFormatDate() {
        assertEquals("1998", Work::rearrangeDate("1998"));
        assertEquals("1998-02", Work::rearrangeDate("1998-02"));
        assertEquals("1998-02-03", Work::rearrangeDate("1998-02-03"));
        assertEquals("1998-02", Work::rearrangeDate("02-1998"));
        assertEquals("1998-02-03", Work::rearrangeDate("03-02-1998"));

        assertEquals("2021-04-23", Work::rearrangeDate("2021:04:23 10:33:59"));

        assertFalse(Work::rearrangeDate("199?"));
        assertFalse(Work::rearrangeDate("19999"));
    }

}
