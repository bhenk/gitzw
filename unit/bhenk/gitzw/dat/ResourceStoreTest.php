<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotFalse;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class ResourceStoreTest extends TestCase {
    use ConsoleLoggerTrait {
        setUp as public traitSetUp;
    }

    private ResourceStore $store;

    public function setUp(): void {
        $this->traitSetUp();
        Dao::resourceDao()->createTable(true);
        Dao::representationDao()->createTable(true);
        Dao::resJoinRepDao()->createTable(true);
        Dao::creatorDao()->createTable(true);
        $this->store = new ResourceStore();
    }

    /**
     * @throws Exception
     */
    public function testStoreResource() {
        $resource = new Resource();
        $resource->setRESID("hnq/work/paint/2020/0001");
        $resource->setCategory("paint");
        $resource->setPreferredLanguage("en");
        $resource->setTitleEn("An English title");
        $resource->setTitleNl("Een Nederlandse titel");
        $resource->setDate("2020");
        $resource->setDepth(12);
        $resource->setHeight(10);
        $resource->setWidth(8);
        $resource->setMedia("mixed media");
        $resource->setOrdinal(42);
        $resource->setHidden(true);
        $result = $this->store->persist($resource);
        assertTrue($resource->getResourceDo()->equals($result->getResourceDo()));

        $resource = $result;
        $resource->setRESID("foo/bar");
        $result = $this->store->persist($resource);
        assertTrue($resource->getResourceDo()->isSame($result->getResourceDo()));
        assertEquals("foo/bar", $result->getRESID());

        $result = $this->store->select($resource->getID());
        assertTrue($resource->getResourceDo()->isSame($result->getResourceDo()));

        $result = $this->store->selectByRESID($resource->getRESID());
        assertTrue($resource->getResourceDo()->isSame($result->getResourceDo()));
    }

    /**
     * @throws Exception
     */
    public function testGetResourceById() {
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

        // Create a Resource and populate properties and relations
        $resource = new Resource();
        $resource->setRESID("RESID_1");
        $relations = $resource->getRelations();
        $relation = $relations->addRepresentation($representation);
        assertNotFalse($relation);
        $relation->setOrdinal(42);
        $relation->setDescription("Yet an other representation of this resource");
        $relation->setPreferred(false);
        $relation->setHidden(true);
        $resource = Store::resourceStore()->persist($resource);

        // Fetch the Resource
        $resource = Store::resourceStore()->select($resource->getID());
        assertEquals("RESID_1", $resource->getRESID());
        $relations = $resource->getRelations();
        $representation = $relations->getRepresentation($representation->getID());
        assertEquals("REPID_1", $representation->getREPID());
        assertEquals("iPhone", $representation->getSource());
        $relation = $relations->getRelation($representation->getID());
        assertEquals(42, $relation->getOrdinal());
        assertEquals("Yet an other representation of this resource", $relation->getDescription());
        assertFalse($relation->isPreferred());
        assertTrue(($relation->isHidden()));

        // Fetch the Representation
        $representation = Store::representationStore()->select($representation->getID());
        $resource2 = $representation->getRelations()->getResource($resource->getID());
        assertTrue($resource->getResourceDo()->isSame($resource2->getResourceDo()));

        // Remove the relation
        $relations->removeRepresentation($representation->getID());
        assertTrue($relation->isDeleted());
        assertNull($relations->getRepresentation($representation->getID()));
        $resource = Store::resourceStore()->persist($resource);

        // Fetch the Resource
        $resource = Store::resourceStore()->select($resource->getID());
        $relations = $resource->getRelations();
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

        $resource = new Resource();
        $resource->setRESID("TEST_ADD_CREATOR");
        $resource->setCreator($creator->getID());
        $resource = Store::resourceStore()->persist($resource);

        // Fetch resource
        $resource2 = Store::resourceStore()->select($resource->getID());
        $creator = $resource2->getCreator();
        assertEquals("Piet", $creator->getFirstname());

        $resource2->unsetCreator();
        assertFalse($resource2->getCreator());
        $resource2 = Store::resourceStore()->persist($resource2);

        $resource3 = Store::resourceStore()->select($resource2->getID());
        assertFalse($resource3->getCreator());
    }

}
