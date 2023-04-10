<?php

namespace bhenk\gitzw\dat;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertStringContainsString;

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
    }
}
