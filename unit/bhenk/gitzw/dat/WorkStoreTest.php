<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ExhibitionDo;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\dao\WorkHasRepDo;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use function array_values;
use function implode;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotFalse;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class WorkStoreTest extends TestCaseDb {

    /**
     * @throws Exception
     */
    public function testStoreWork() {
        $work = new Work();
        $work->setRESID("hnq/work/paint/2020/0001");
        $work->setCategory("paint");
        $work->setPreferredLanguage("en");
        $work->setTitleEn("An English title");
        $work->setTitleNl("Een Nederlandse titel");
        $work->setDate("2020");
        $work->setDepth(12);
        $work->setHeight(10);
        $work->setWidth(8);
        $work->setMedia("mixed media");
        $work->setOrdinal(42);
        $work->setHidden(true);
        $result = Store::workStore()->persist($work);
        assertTrue($work->getWorkDo()->equals($result->getWorkDo()));

        $work = $result;
        $work->setRESID("foo/bar");
        $result = Store::workStore()->persist($work);
        assertTrue($work->getWorkDo()->isSame($result->getWorkDo()));
        assertEquals("foo/bar", $result->getRESID());

        $result = Store::workStore()->select($work->getID());
        assertTrue($work->getWorkDo()->isSame($result->getWorkDo()));

        $result = Store::workStore()->selectByRESID($work->getRESID());
        assertTrue($work->getWorkDo()->isSame($result->getWorkDo()));
    }

    /**
     * @throws Exception
     */
    public function testGetWorkById() {
        assertFalse(Store::workStore()->select(-1));
    }

    /**
     * @throws Exception
     */
    public function testPersistWithRelations() {
        $representation = new Representation();
        $representation->setREPID("REPID_1");
        $representation->setSource("iPhone");
        $representation = Store::representationStore()->persist($representation);
        assertNotNull($representation->getID());

        // Create a Work and populate properties and relations
        $work = new Work();
        $work->setRESID("RESID_1");
        $relations = $work->getRelations();
        $relation = $relations->addRepresentation($representation);
        assertNotFalse($relation);
        $relation->setOrdinal(42);
        $relation->setDescription("Yet an other representation of this work");
        $relation->setPreferred(false);
        $relation->setHidden(true);
        $work = Store::workStore()->persist($work);

        // Fetch the Work
        $work = Store::workStore()->select($work->getID());
        assertEquals("RESID_1", $work->getRESID());
        $relations = $work->getRelations();
        $representation = $relations->getRepresentation($representation->getID());
        assertEquals("REPID_1", $representation->getREPID());
        assertEquals("iPhone", $representation->getSource());
        $relation = $relations->getRelation($representation->getID());
        assertEquals(42, $relation->getOrdinal());
        assertEquals("Yet an other representation of this work", $relation->getDescription());
        assertFalse($relation->isPreferred());
        assertTrue(($relation->isHidden()));

        // Fetch the Representation
        $representation = Store::representationStore()->select($representation->getID());
        $work2 = $representation->getRelations()->getWork($work->getID());
        assertTrue($work->getWorkDo()->isSame($work2->getWorkDo()));

        // Remove the relation
        $relations->removeRepresentation($representation->getID());
        assertFalse($relation->isDeleted());
//        assertNull($relations->getRepresentation($representation->getID()));
//        $work = Store::workStore()->persist($work);
//
//        // Fetch the Work
//        $work = Store::workStore()->select($work->getID());
//        $relations = $work->getRelations();
//        assertNull($relations->getRepresentation($representation->getID()));
//        assertNull($relations->getRelation($representation->getID()));
//        $representations = $relations->getRepresentations();
//        assertEmpty($representations);
    }

    /**
     * @throws Exception
     */
    public function testSetCreator() {
        $creator = new Creator();
        $creator->setFirstname("Piet");
        $creator->setCRID("CRID_42");
        $creator = Store::creatorStore()->persist($creator);

        $work = new Work();
        $work->setRESID("TEST_ADD_CREATOR");
        $work->setCreator($creator->getID());
        $work = Store::workStore()->persist($work);

        // Fetch work
        $work2 = Store::workStore()->select($work->getID());
        $creator = $work2->getCreator();
        assertEquals("Piet", $creator->getFirstname());

        $work2->unsetCreator();
        assertFalse($work2->getCreator());
        $work2 = Store::workStore()->persist($work2);

        $work3 = Store::workStore()->select($work2->getID());
        assertFalse($work3->getCreator());
    }

    /**
     * @throws Exception
     */
    public function testRemoveRepresentationWithExhibitions() {
        $representation = new Representation(new RepresentationDo(null, "REPID_k"));
        $representation = Store::representationStore()->persist($representation);
        $work = new Work(new WorkDo(null, "RESID_X"));
        $work->getRelations()->addRepresentation($representation);
        $work = Store::workStore()->persist($work);
        $exhibition = new Exhibition(new ExhibitionDo(null, "EXHID+Y"));
        $exhibition->getRelations()->addRepresentation($representation);
        $exhibition = Store::exhibitionStore()->persist($exhibition);

        assertFalse($work->getRelations()->removeRepresentation($representation));
        assertEquals("Representation:1 cannot be removed. Last Representation of Work:1",
            $work->getRelations()->getLastMessage());

        assertTrue($exhibition->getRelations()->removeRepresentation($representation));
        assertFalse($exhibition->getRelations()->getLastMessage());
        Store::exhibitionStore()->persist($exhibition);

        assertFalse($work->getRelations()->removeRepresentation($representation));
//        assertFalse($work->getRelations()->getLastMessage());
//        assertEmpty($work->getRelations()->getRepresentations());
//        /** @var WorkHasRepDo $workHasRepDo */
//        $workHasRepDo = array_values($work->getRelations()->getRepRelations())[0];
//        assertTrue($workHasRepDo->isDeleted());
//
//        $work = Store::workStore()->persist($work);
//        assertEmpty($work->getRelations()->getRepresentations());
//        assertEmpty($work->getRelations()->getRepRelations());
    }

    /**
     * @throws Exception
     */
    public function testDeleteWorkWithRepresentationWithExhibition() {
        $representation = new Representation(new RepresentationDo(null, "REPID_k"));
        $representation = Store::representationStore()->persist($representation);
        $work = new Work(new WorkDo(null, "RESID_X"));
        $work->getRelations()->addRepresentation($representation);
        $work = Store::workStore()->persist($work);
        $exhibition = new Exhibition(new ExhibitionDo(null, "EXHID+Y"));
        $exhibition->getRelations()->addRepresentation($representation);
        $exhibition = Store::exhibitionStore()->persist($exhibition);

        assertEquals(0, Store::workStore()->delete($work));
        assertEquals("Work:1 has 1 Exhibition and cannot be deleted", Store::workStore()->getLastMessage());

        $exhibition->getRelations()->removeRepresentation($representation);
        Store::exhibitionStore()->persist($exhibition);
        $work = Store::workStore()->select(1);
        assertEquals(1, Store::workStore()->delete($work),
            implode(PHP_EOL . "- ", Store::workStore()->getMessages()));
    }

}
