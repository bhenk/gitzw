<?php

namespace bhenk\gitzw\dat;

use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function array_keys;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

#[LogAttribute(false)]
class RoWorkTest extends TestCaseRo {

    #[LogAttribute(false)]
    public function testGetStructuredData() {
        $work = Store::workStore()->selectByRESID("hnq.work.paint.2021.0022");
        $sd = $work->getStructuredData();
        assertEquals("VisualArtwork", $sd["@type"]);
        assertEquals(179, $work->getOrder());
    }

    public function testGetWorkRepresentations() {
        $work = Store::workStore()->selectByRESID("hnq.work.draw.1986.0000");
        $workRepresentations = $work->getRelations()->getWorkRepresentations();
        $ordinals = [];
        foreach ($workRepresentations as $key => $workRepresentation) {
//            echo "\n" . $workRepresentation->getOrdinal() . "<-ordinal \n"
//                . $workRepresentation->getDescription() . "<- \n"
//                . $workRepresentation->getRepresentation()->getID() . "<- id ->$key\n"
//                . $workRepresentation->getRepresentation()->getDescription() . "<- rep desc\n";
            $ordinals[] = $workRepresentation->getOrdinal();
        }
        assertEquals([1, 2, 3, 4, PHP_INT_MAX], $ordinals);
        assertEquals([11, 12, 13, 14, 10], array_keys($workRepresentations));
    }

    public function testGetOtherWorkRepresentations() {
        $work = Store::workStore()->selectByRESID("hnq.work.draw.1986.0000");
        $workRepresentations = $work->getRelations()->getWorkRepresentations();
        $others = $work->getRelations()->getOtherWorkRepresentations();
        assertEquals($workRepresentations, $others);

        $others = $work->getRelations()->getOtherWorkRepresentations([10]);
        //var_dump(array_keys($others));
        assertEquals([11, 12, 13, 14], array_keys($others));

        $others = $work->getRelations()->getOtherWorkRepresentations([10, 13, 11]);
        assertEquals([12, 14], array_keys($others));
    }

    public function testGetSurfaceAndMediaCodes() {
        $work = Store::workStore()->selectByRESID("hnq.work.draw.2022.0013");
        list($surface_codes, $media_codes) = $work->getSurfaceAndMediaCodes();
        //var_dump($work->getSurfaceAndMediaCodes());
        assertEquals(1,1);
        //var_dump($surface_codes);
    }

}
