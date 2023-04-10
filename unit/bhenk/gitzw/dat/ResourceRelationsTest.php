<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\RepresentationDo;
use Exception;
use PHPUnit\Framework\TestCase;
use function count;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

class ResourceRelationsTest extends TestCase {

    /**
     * @throws Exception
     */
    public function testGetRelations() {
        $resRel = new ResourceRelations();
        $relations = $resRel->getRelations();
        assertEmpty($relations);
        $representations = $resRel->getRepresentations();
        assertEmpty($representations);
    }

    /**
     * @throws Exception
     */
    public function testAddRepresentation() {
        $resRel = new ResourceRelations();
        assertFalse($resRel->addRepresentation(-1));
        assertFalse($resRel->addRepresentation("Bingo"));
        assertFalse($resRel->addRepresentation(new Representation()));

        $repr = new Representation(new RepresentationDo(42));
        $relation = $resRel->addRepresentation($repr);
        assertEquals(42, $relation->getFkRight());
        assertNull($relation->getFkLeft());
        $representations = $resRel->getRepresentations();
        assertEquals(1, count($representations));
        assertArrayHasKey(42, $representations);
        assertContains($repr, $representations);
        $relations = $resRel->getRelations();
        assertEquals(1, count($relations));
        assertArrayHasKey(42, $relations);
        assertFalse($resRel->addRepresentation(42));
        assertFalse($resRel->addRepresentation($repr));

        assertTrue($resRel->removeRepresentation($repr));
        assertEquals(1, count($resRel->getRelations()));
        assertEmpty($resRel->getRepresentations());
    }
}
