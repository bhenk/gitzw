<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ExhibitionDo;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dao\WorkDo;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotFalse;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class RepresentationStoreTest extends TestCaseDb {

    /**
     * @throws Exception
     */
    #[LogAttribute(true)]
    public function testPersist() {
        $representation = new Representation();
        $representation->setREPID("REPID_1");
        $representation->setDescription("A description");
        $representation->setSource("Nikon");
        $result = Store::representationStore()->persist($representation);
        assertTrue($representation->getRepresentationDo()->equals($result->getRepresentationDo()));
        assertFalse($representation->getRepresentationDo()->isSame($result->getRepresentationDo()));

        $result->setDescription("A new description");
        Store::representationStore()->persist($result);

        $byId = Store::representationStore()->select($result->getID());
        assertEquals("A new description", $byId->getDescription());

        $byRepId = Store::representationStore()->selectByREPID("REPID_1");
        assertEquals("Nikon", $byRepId->getSource());
        assertEquals(1, Store::representationStore()->deleteWhere("source='Nikon'"));
        assertFalse(Store::representationStore()->getLastMessage());
        assertEmpty(Store::representationStore()->selectWhere("source='Nikon'"));

    }

    /**
     * @throws Exception
     */
    #[LogAttribute(false)]
    public function testDeleteRule() {
        $representation = new Representation(new RepresentationDo(null, "REPID_42"));
        $representation = Store::representationStore()->persist($representation);

        $work = new Work(new WorkDo(null, "RESID_X"));
        $work->getRelations()->addRepresentation($representation);
        $work = Store::workStore()->persist($work);

        $exhibition = new Exhibition(new ExhibitionDo(null, "EXHID_Y"));
        $exhibition->getRelations()->addRepresentation($representation);
        $exhibition = Store::exhibitionStore()->persist($exhibition);

        $result = Store::representationStore()->delete($representation);
        assertEquals(0, $result);
        assertEquals("Representation:1 is owned by 1 Works and cannot be deleted",
            Store::representationStore()->getLastMessage());

        $result = $work->getRelations()->removeRepresentation($representation);
        assertFalse($result);
        assertEquals("Representation:1 cannot be removed. Last Representation of Work:1",
            $work->getRelations()->getLastMessage());

        $result = $exhibition->getRelations()->removeRepresentation($representation);
        assertTrue($result);
        assertFalse($exhibition->getRelations()->getLastMessage());
        Store::exhibitionStore()->persist($exhibition);

        $result = $work->getRelations()->removeRepresentation($representation);
        assertFalse($result);
        assertNotFalse($work->getRelations()->getLastMessage());
//        Store::workStore()->persist($work);
//
//        $result = Store::representationStore()->delete($representation);
//        assertEquals(1, $result);
//        assertFalse(Store::representationStore()->getLastMessage());
    }

}
