<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\dao\WorkHasRepDo;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use function array_keys;
use function array_values;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFileExists;
use function PHPUnit\Framework\assertTrue;

#[LogAttribute(false)]
class StoreTest extends TestCaseDb {

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
        $works1 = $this->makeWorks($representations1, $creators1);
        // serialize
        $counts = Store::serialize();
        $filename = Store::getDataStore() . DIRECTORY_SEPARATOR . "creators"
            . DIRECTORY_SEPARATOR . "creator_00005.json";
        assertFileExists($filename);
        assertEquals(5, $counts["creators"]);
        assertEquals(count($representations1), $counts["representations"]);
        assertEquals(2, $counts["works"]);
        assertEquals(4, $counts["work_relations"]);

        // deserialize
        $counts = Store::deserialize();

        $creators2 = Store::creatorStore()->selectBatch([1, 2, 3, 4, 5]);
        assertEquals(5, $counts["creators"]);
        for ($i = 0; $i < 5; $i++) {
            $cre1 = $creators1[$i + 1]->getCreatorDo();
            $cre2 = $creators2[$i + 1]->getCreatorDo();
            assertTrue($cre1->isSame($cre2));
        }
        $representations2 = Store::representationStore()->selectBatch(array_keys($representations1));
        assertEquals($representations1, $representations2);

        $works2 = Store::workStore()->selectBatch(array_keys($works1));
        for ($i = 1; $i < 3; $i++) {
            $wodo1 = $works1[$i]->getWorkDo();
            $wodo2 = $works2[$i]->getWorkDo();
            assertTrue($wodo1->isSame($wodo2));

            $relations1 = $works1[$i]->getRelations()->getRepresentationRelations();
            $relations2 = $works2[$i]->getRelations()->getRepresentationRelations();
            for ($j = 0; $j < 2; $j++) {
                /** @var WorkHasRepDo $whr1 */
                $whr1 = array_values($relations1)[$j];
                $whr2 = array_values($relations2)[$j];
                assertTrue($whr1->isSame($whr2));
            }

        }
        $creator = Store::creatorStore()->selectByCRID("CRID_02");
        $works = $creator->getWorks();
        assertEquals($creator, $works[1]->getCreator());
    }

    /**
     * @return Creator[]
     * @throws Exception
     */
    private function makeCreators(): array {
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

    /**
     * @throws Exception
     */
    private function makeWorks(array $representations, array $creators): array {
        $work1 = new Work(new WorkDo(null, "RESID_01", "title01", "titel01"));
        $work1->getRelations()->addRepresentation($representations[1]);
        $work1->getRelations()->addRepresentation($representations[2]);
        $work1->setDate("2021-12-09");
        $work1->setCreator($creators[2]);
        $work2 = new Work(new WorkDo(null, "RESID_02", "title02", "titel02"));
        $work2->getRelations()->addRepresentation($representations[3]);
        $work2->getRelations()->addRepresentation($representations[2]);
        $work2->setCreator($creators[1]);
        return Store::workStore()->persistBatch([$work1, $work2]);
    }

    /**
     * @throws Exception
     */
    public function testDelete() {
        $creators = $this->makeCreators();
        $representations = $this->makeRepresentations();
        $works = $this->makeWorks($representations, $creators);

        $creator = Store::creatorStore()->selectByCRID("CRID_02");
        $work = $creator->getWorks()[1];
        assertEquals($creator, $work->getCreator());
        assertEquals("RESID_01", $work->getRESID());
        $this->expectException(Exception::class);
        Store::creatorStore()->delete($creator->getID());
    }
}
