<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dao\WorkDo;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use function array_keys;
use function array_values;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotFalse;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class WorkStoreTest extends TestCase {
    use ConsoleLoggerTrait {
        setUp as public traitSetUp;
    }

    private WorkStore $store;

    public function setUp(): void {
        $this->traitSetUp();
        Dao::workDao()->createTable(true);
        Dao::representationDao()->createTable(true);
        Dao::workHasRepDao()->createTable(true);
        Dao::creatorDao()->createTable(true);
        $this->store = new WorkStore();
    }

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
        $result = $this->store->persist($work);
        assertTrue($work->getWorkDo()->equals($result->getWorkDo()));

        $work = $result;
        $work->setRESID("foo/bar");
        $result = $this->store->persist($work);
        assertTrue($work->getWorkDo()->isSame($result->getWorkDo()));
        assertEquals("foo/bar", $result->getRESID());

        $result = $this->store->select($work->getID());
        assertTrue($work->getWorkDo()->isSame($result->getWorkDo()));

        $result = $this->store->selectByRESID($work->getRESID());
        assertTrue($work->getWorkDo()->isSame($result->getWorkDo()));
    }

    /**
     * @throws Exception
     */
    public function testGetWorkById() {
        assertFalse($this->store->select(-1));
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
        assertTrue($relation->isDeleted());
        assertNull($relations->getRepresentation($representation->getID()));
        $work = Store::workStore()->persist($work);

        // Fetch the Work
        $work = Store::workStore()->select($work->getID());
        $relations = $work->getRelations();
        assertNull($relations->getRepresentation($representation->getID()));
        assertNull($relations->getRelation($representation->getID()));
        $representations = $relations->getRepresentations();
        assertEmpty($representations);
    }

    /**
     * @throws Exception
     */
    public function testSetCreator() {
        $creator = new Creator();
        $creator->setFirstname("Piet");
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
    public function testSerialize() {
        $representations = $this->makeRepresentations();
        $work1 = new Work(new WorkDo(null, "RESID_01", "title01", "titel01"));
        $work1->getRelations()->addRepresentation($representations[1]);
        $work1->getRelations()->addRepresentation($representations[2]);
        $work2 = new Work(new WorkDo(null, "RESID_02", "title02", "titel02"));
        $work2->getRelations()->addRepresentation($representations[3]);
        $work2->getRelations()->addRepresentation($representations[2]);
        $works = $this->store->persistBatch([$work1, $work2]);

        $countArray1 = $this->store->serialize(Store::getDataStore());
        assertEquals([2, 4], array_values($countArray1));

        $countArray2 = $this->store->deserialize(Store::getDataStore());
        assertEquals($countArray1, $countArray2);
    }

    /**
     * @return Representation[]
     * @throws Exception
     */
    private function makeRepresentations(): array {
        Dao::representationDao()->createTable(true);
        $rep1 = new Representation(new RepresentationDo(null, "REPID_01", "iPhone"));
        $rep1->setDate("1998");
        $rep2 = new Representation(new RepresentationDo(null, "REPID_02", "Nikon"));
        $rep2->setDate("1998-06");
        $rep3 = new Representation(new RepresentationDo(null, "REPID_03", "unknown"));
        $rep3->setDate("1998-07-15");
        $persisted = Store::representationStore()->persistBatch([$rep1, $rep2, $rep3]);
        assertEquals([1, 2, 3], array_keys($persisted));
        return $persisted;
    }

}
