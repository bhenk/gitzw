<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\RepresentationDao;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use function array_keys;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class RepresentationStoreTest extends TestCase {
    use ConsoleLoggerTrait {
        setUp as public traitSetUp;
    }

    private RepresentationStore $store;

    public function setUp(): void {
        $this->traitSetUp();
        (new RepresentationDao())->createTable(true);
        $this->store = new RepresentationStore();
    }

    /**
     * @throws Exception
     */
    public function testPersist() {
        $representation = new Representation();
        $representation->setREPID("REPID_1");
        $representation->setDescription("A description");
        $representation->setSource("Nikon");
        $result = $this->store->persist($representation);
        assertTrue($representation->getRepresentationDo()->equals($result->getRepresentationDo()));
        assertFalse($representation->getRepresentationDo()->isSame($result->getRepresentationDo()));

        $result->setDescription("A new description");
        $this->store->persist($result);

        $byId = $this->store->select($result->getID());
        assertEquals("A new description", $byId->getDescription());

        $byRepId = $this->store->selectByREPID("REPID_1");
        assertEquals("Nikon", $byRepId->getSource());
        assertEquals(1, $this->store->deleteWhere("source='Nikon'"));
        assertEmpty($this->store->selectWhere("source='Nikon'"));
    }

    public function testSerialize() {
        $rep1 = new Representation(new RepresentationDo(null, "REPID_01", "iPhone"));
        $rep1->setDate("1998");
        $rep2 = new Representation(new RepresentationDo(null, "REPID_02", "Nikon"));
        $rep2->setDate("1998-06");
        $rep3 = new Representation(new RepresentationDo(null, "REPID_03", "unknown"));
        $rep3->setDate("1998-07-15");
        $persisted = $this->store->persistBatch([$rep1, $rep2, $rep3]);
        assertEquals([1, 2, 3], array_keys($persisted));
        $count = $this->store->serialize(Store::getDataStore());
        assertEquals(3, $count);

        $count = $this->store->deserialize(Store::getDataStore());
        assertEquals(3, $count);
        assertFalse(Dao::representationDao()->isTemp());

        Dao::representationDao()->setTemp(true);
        $repArray = $this->store->selectWhere("date='1998-07-15'");
        assertEquals(3, $repArray[3]->getID());
        assertEquals("1998-07-15", $repArray[3]->getDate());
        $rep = $this->store->select(2);
        assertEquals("1998-06", $rep->getDate());

        Dao::representationDao()->setTemp(false);
    }

}
