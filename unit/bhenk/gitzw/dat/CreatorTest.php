<?php

namespace bhenk\gitzw\dat;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertStringContainsString;
use function PHPUnit\Framework\assertTrue;

class CreatorTest extends TestCase {

    public function testGetSDCard() {
        $creator = new Creator();
        $creator->setCRID("http://example.com/xfz");
        $creator->setFirstname("Piet");
        $creator->setPrefixes("van");
        $creator->setLastname("Pietersen");
        $creator->setUrl("http://example.com/pvp");
        $creator->setDescription("Piet loves to go fishing");
        $creator->setSameAs(["https://fishingpro.com/piet", "https://fishingrots.com/Pietersen"]);
        assertStringContainsString('"name": "Piet van Pietersen",', $creator->getSDCard());
        assertEquals("xfz", $creator->getShortCRID());
    }

    /**
     * @throws ReflectionException
     */
    public function testJsonSerialize() {
        $creator = new Creator();
        $creator->setCRID("http://example.com/xfz");
        $creator->setFirstname("Piet");
        $creator->setPrefixes("van");
        $creator->setLastname("Pietersen");
        $creator->setUrl("http://example.com/pvp");
        $creator->setDescription("Piet loves to go fishing");
        $creator->setSameAs(["https://fishingpro.com/piet", "https://fishingrots.com/Pietersen"]);
        $serialized = $creator->serialize();
        $creator2 = Creator::deserialize($serialized);
        assertTrue($creator->getCreatorDo()->isSame($creator2->getCreatorDo()));
    }
}
