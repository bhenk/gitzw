<?php

namespace bhenk\gitzw\dat;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

#[LogAttribute(false)]
class RoWorkTest extends TestCaseRo {

    public function testGetStructuredData() {
        $work = Store::workStore()->selectByRESID("hnq.work.paint.2021.0022");
        $sd = $work->getStructuredData();
        assertEquals("VisualArtwork", $sd["@type"]);
    }

}
