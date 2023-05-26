<?php

namespace bhenk\gitzw\base;

use PHPUnit\Framework\TestCase;
use function array_keys;
use function fwrite;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

class AATTest extends TestCase {

    public function testAllTerms() {
//        $aat = new AAT();
//        //$aat->generateJson();
//        $term = "aat:300022457";
//        $labels = $aat->getPreferredLabels($term);
//        //echo $term;
//        foreach ($labels as $label) {
//            fwrite(STDOUT, $label->getLanguage() . " => " . $label->getLiteral() . "\n");
//        }
        assertEquals(1, 1);
    }

    public function testGetMedia() {
        $aat = new AAT();
        $all = $aat->getMedia("acrylic on canvas. 2 x");
        //var_dump($all);
        assertArrayHasKey("aat:300015058", $all);
        assertArrayHasKey("aat:300014078", $all);
    }

    public function testGetTypes() {
        $aat = new AAT();
        $all = $aat->getTypes([]);
        self::assertEmpty($all);

        $all = $aat->getTypes(["Oil Painting", "Collage"]);
        //var_dump($all);
        assertArrayHasKey("aat:300033963", $all);
        assertArrayHasKey("aat:300033799", $all);
    }

//    public function testGetUrls() {
//        $aat = new AAT();
//        foreach (array_keys($aat->allTerms()) as $term) {
//            var_dump(AAT::getPageUrl($term));
//        }
//    }
}
