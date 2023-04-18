<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\dao\Dao;
use Exception;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFileExists;
use function PHPUnit\Framework\assertTrue;

class CreatorStoreTest extends TestCase {

    /**
     * @throws Exception
     */
    public function testSerialize() {
        Dao::creatorDao()->createTable(true);
        $creators = [
            new Creator(new CreatorDo(null, "CRID_01", "Piet")),
            new Creator(new CreatorDo(null, "CRID_02", "Ellen")),
            new Creator(new CreatorDo(null, "CRID_03", "Kees")),
            new Creator(new CreatorDo(null, "CRID_04", "Mariet")),
            new Creator(new CreatorDo(null, "CRID_05", "Ben")),
        ];
        $creators1 = Store::creatorStore()->persistBatch($creators);
        // serialize
        $count = Store::creatorStore()->serialize(Store::getDataStore());
        $filename = Store::getDataStore() . DIRECTORY_SEPARATOR . CreatorStore::SERIALIZATION_DIRECTORY
            . DIRECTORY_SEPARATOR . "creator_00005.json";
        assertFileExists($filename);
        assertEquals(5, $count);
        // deserialize
        $count = Store::creatorStore()->deserialize(Store::getDataStore());
        assertEquals(5, $count);
        Dao::creatorDao()->setTemp(true);
        $creators2 = Store::creatorStore()->selectBatch([1, 2, 3, 4, 5]);
        for ($i = 1; $i < 6; $i++) {
            $cre1 = $creators1[$i]->getCreatorDo();
            $cre2 = $creators2[$i]->getCreatorDo();
            assertTrue($cre1->isSame($cre2));
        }
        Dao::creatorDao()->setTemp(false);
    }

}
