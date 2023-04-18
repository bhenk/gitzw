<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use Exception;
use PHPUnit\Framework\TestCase;
use function array_keys;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertFileExists;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class StoreTest extends TestCase {
    use ConsoleLoggerTrait;

    /**
     * @throws Exception
     */
    #[LogAttribute(false)]
    public function testGetDataStore() {
        $datastore = Store::getDataStore();
        self::assertDirectoryExists($datastore);
    }

    /**
     * @throws Exception
     */
    #[LogAttribute(false)]
    public function testSerialize() {
        $creators1 = $this->makeCreators();
        $representations1 = $this->makeRepresentations();
        // serialize
        $counts = Store::serialize();
        $filename = Store::getDataStore() . DIRECTORY_SEPARATOR . "creators"
            . DIRECTORY_SEPARATOR . "creator_00005.json";
        assertFileExists($filename);
        assertEquals(5, $counts["creators"]);
        assertEquals(count($representations1), $counts["representations"]);

        // deserialize
        $counts = Store::deserialize();
        assertFalse(Dao::creatorDao()->isTemp());
        assertFalse(Dao::representationDao()->isTemp());
        Dao::creatorDao()->setTemp(true);
        Dao::representationDao()->setTemp(true);
        $creators2 = Store::creatorStore()->selectBatch([1, 2, 3, 4, 5]);
        assertEquals(5, $counts["creators"]);
        for ($i = 0; $i < 5; $i++) {
            $cre1 = $creators1[$i + 1]->getCreatorDo();
            $cre2 = $creators2[$i + 1]->getCreatorDo();
            assertTrue($cre1->isSame($cre2));
        }
        $representations2 = Store::representationStore()->selectBatch(array_keys($representations1));
        assertEquals($representations1, $representations2);

        Dao::creatorDao()->setTemp(false);
        Dao::representationDao()->setTemp(false);
    }

    /**
     * @return Creator[]
     * @throws Exception
     */
    private function makeCreators(): array {
        Dao::creatorDao()->createTable(true);
        $creators = [
            new Creator(new CreatorDo(null, "CRID_01", "Piet")),
            new Creator(new CreatorDo(null, "CRID_02", "Ellen")),
            new Creator(new CreatorDo(null, "CRID_03", "Kees")),
            new Creator(new CreatorDo(null, "CRID_04", "Mariet")),
            new Creator(new CreatorDo(null, "CRID_05", "Ben")),
        ];
        return Store::creatorStore()->persistBatch($creators);
    }

    /**
     * @return Representation[]
     * @throws Exception
     */
    private function makeRepresentations(): array {
        Dao::representationDao()->createTable(true);
        $rep1 = new Representation(new RepresentationDo(null, "REPID_01", "iPhone"));
        $rep1->setDate("1998");
        $rep2 = new Representation(new RepresentationDo(null, "REPID_02", "Nikon"));
        $rep2->setDate("1998-06");
        $rep3 = new Representation(new RepresentationDo(null, "REPID_03", "unknown"));
        $rep3->setDate("1998-07-15");
        $persisted = Store::representationStore()->persistBatch([$rep1, $rep2, $rep3]);
        assertEquals([1, 2, 3], array_keys($persisted));
        return $persisted;
    }
}
