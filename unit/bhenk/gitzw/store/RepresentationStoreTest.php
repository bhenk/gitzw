<?php

namespace bhenk\gitzw\store;

use bhenk\gitzw\dao\RepresentationDao;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\RepresentationStore;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
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
    public function testStoreRepresentation() {
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
    }

}
