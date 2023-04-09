<?php

namespace bhenk\gitzw\store;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Resource;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use function array_values;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotNull;
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

        $resource = new Resource();
        $resource->setRESID("RESID_1");
        $relations = $resource->getRelations();
        $relations->addRepresentation($representation);
        $resource = Store::resourceStore()->persist($resource);

        $resource = Store::resourceStore()->select($resource->getID());
        assertEquals("RESID_1", $resource->getRESID());
        $relations = $resource->getRelations();
        $representation = array_values($relations->getRepresentations())[0];
        assertEquals("REPID_1", $representation->getREPID());

        $relations->removeRepresentation($representation->getID());
        $resource = Store::resourceStore()->persist($resource);
        $resource = Store::resourceStore()->select($resource->getID());
        $relations = $resource->getRelations();
        $representations = $relations->getRepresentations();
        assertEmpty($representations);
    }

}
