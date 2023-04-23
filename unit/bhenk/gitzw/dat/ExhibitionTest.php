<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ExhibitionDo;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dao\WorkDo;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;

#[LogAttribute(false)]
class ExhibitionTest extends TestCaseDb {

    /**
     * @throws Exception
     */
    public function testAddRepresentation() {
        // Exhibition.add Representation # <- MUST: Representation is related to at least 1 Work
        $exhibition = new Exhibition(new ExhibitionDo(null, "EXHID_G"));
        $representation = new Representation(new RepresentationDo(null, "REPID_O"));
        assertFalse($exhibition->getRelations()->addRepresentation($representation));
        assertEquals("Representation not persistent", $exhibition->getRelations()->getLastMessage());

        $representation = Store::representationStore()->persist($representation);
        assertFalse($exhibition->getRelations()->addRepresentation($representation));
        assertEquals("Representation:1 not related to a Work and cannot be added to Exhibition:",
            $exhibition->getRelations()->getLastMessage());

        $work = new Work(new WorkDo(null, "RESID_D"));
        $do = $work->getRelations()->addRepresentation($representation);
        assertEquals(1, $do->getFkRight());
        Store::workStore()->persist($work);
        $do = $exhibition->getRelations()->addRepresentation($representation);
        assertEquals(1, $do->getFkRight());
    }

}
