<?php

namespace bhenk\gitzw\dat;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class RepresentationStoreTest extends TestCaseDb {

    /**
     * @throws Exception
     */
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
        assertEmpty(Store::representationStore()->selectWhere("source='Nikon'"));
    }

}
