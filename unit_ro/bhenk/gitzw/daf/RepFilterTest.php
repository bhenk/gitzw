<?php

namespace bhenk\gitzw\daf;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function PHPUnit\Framework\assertEquals;

#[LogAttribute(false)]
class RepFilterTest extends TestCaseRo {

    public function testConstructor() {
        $filter = new RepExplorerFilter();
        $result = $filter->getSSourceCountSql();
        $split = explode("\n", $result);
        assertEquals("SELECT r.source, COUNT(*) as count FROM tbl_representations r", $split[0]);
        assertEquals("INNER JOIN tbl_work_rep wr ON r.ID = wr.FK_RIGHT", $split[1]);
        assertEquals("GROUP BY r.source ORDER BY r.source;", $split[2]);
    }

}
