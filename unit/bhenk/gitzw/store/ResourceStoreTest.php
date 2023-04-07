<?php

namespace bhenk\gitzw\store;

use bhenk\gitzw\dao\RepresentationDao;
use bhenk\gitzw\dao\ResourceDao;
use bhenk\gitzw\dao\ResRepDao;
use bhenk\gitzw\dao\ResRepDo;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Resource;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class ResourceStoreTest extends TestCase {
    use ConsoleLoggerTrait {
        setUp as public traitSetUp;
    }

    private ResourceStore $store;

    public function setUp(): void {
        $this->traitSetUp();
        (new ResRepDao())->createTable(true);
        (new ResourceDao())->createTable(true);
        (new RepresentationDao())->createTable(true);
        $this->store = new ResourceStore();
    }

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
        $result = $this->store->storeResource($resource);
        assertTrue($resource->getResourceDo()->equals($result->getResourceDo()));

        $resource = $result;
        $resource->setRESID("foo/bar");
        $result = $this->store->storeResource($resource);
        assertTrue($resource->getResourceDo()->isSame($result->getResourceDo()));
        assertEquals("foo/bar", $result->getRESID());

        $result = $this->store->getResourceById($resource->getID());
        assertTrue($resource->getResourceDo()->isSame($result->getResourceDo()));

        $result = $this->store->getResourceByRESID($resource->getRESID());
        assertTrue($resource->getResourceDo()->isSame($result->getResourceDo()));
    }

    public function testGetResourceById() {
        assertFalse($this->store->getResourceById(-1));
    }

    public function testRelations() {
        $representation = new Representation();
        $representation->setREPID("REPID_22");
        $representation->setSource("iPhone");
        $repoStore = new RepresentationStore();
        $representation = $repoStore->storeRepresentation($representation);

        $resource = new Resource();
        $resource->setRESID("hnq/2");
        $resource->addRepresentation($representation);
        $resource = $this->store->storeResource($resource);

        /** @var ResRepDo $repRel */
        $repRel = $resource->getRepRelations()[$representation->getID()];
        assertEquals($representation->getID(), $repRel->getRepresentationID());
        assertEquals($resource->getID(), $repRel->getResourceID());

        $representations = $resource->getRepresentations();
        $representation = $representations[$representation->getID()];
        assertEquals("REPID_22", $representation->getREPID());
    }

    public function testGetByRESID() {
        $representation = new Representation();
        $representation->setREPID("REPID_22");
        $representation->setSource("iPhone");
        $repoStore = new RepresentationStore();
        $representation = $repoStore->storeRepresentation($representation);

        $resource = new Resource();
        $resource->setRESID("hnq/work");
        $resource->addRepresentation($representation);
        $this->store->storeResource($resource);

        $resource = $this->store->getResourceByRESID("hnq/work");
        $repo = $resource->getRepresentations()[$representation->getID()];
        assertEquals("REPID_22", $repo->getREPID());
        assertEquals($representation->getID(), $repo->getID());

        $repRel = $resource->getRepRelations()[$representation->getID()];
        assertEquals($resource->getID(), $repRel->getResourceID());

        $resource->removeRepresentation($representation);
        assertEmpty($resource->getRepresentations());
        $resource = $this->store->storeResource($resource);
        assertEmpty($resource->getRepresentations());
        assertEmpty($resource->getRepRelations());
    }

    public function testGetById() {
        $representation = new Representation();
        $representation->setREPID("REPID_22");
        $representation->setSource("iPhone");
        $repoStore = new RepresentationStore();
        $representation = $repoStore->storeRepresentation($representation);

        $resource = new Resource();
        $resource->setRESID("resourceAltID");
        $resource->addRepresentation($representation);
        /** @var ResRepDo $resRepDo */
        $resRepDo = $resource->getRepRelations()[$representation->getID()];
        $resRepDo->setOrdinal(44);
        $resource = $this->store->storeResource($resource);

        $resource = $this->store->getResourceById($resource->getID());
        $resRepDo = $resource->getRepRelations()[$representation->getID()];
        assertEquals(44, $resRepDo->getOrdinal());
    }
}
