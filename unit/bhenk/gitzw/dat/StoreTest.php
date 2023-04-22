<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\dao\ExhibitionDo;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\dao\WorkHasRepDo;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseDb;
use Exception;
use function array_keys;
use function array_values;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
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
        $exhibitions1 = $this->makeExhibitions($representations1);
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
        for ($i = 1; $i < 3; $i++) {
            $rep_do1 = $representations1[$i]->getRepresentationDo();
            $rep_do2 = $representations2[$i]->getRepresentationDo();
            assertTrue($rep_do1->isSame($rep_do2));
        }


        $works2 = Store::workStore()->selectBatch(array_keys($works1));
        for ($i = 1; $i < 3; $i++) {
            $wodo1 = $works1[$i]->getWorkDo();
            $wodo2 = $works2[$i]->getWorkDo();
            assertTrue($wodo1->isSame($wodo2));

            $relations1 = $works1[$i]->getRelations()->getRepRelations();
            $relations2 = $works2[$i]->getRelations()->getRepRelations();
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

        $exhibition1 = Store::exhibitionStore()->select(1);
        assertEquals("2020", $exhibition1->getDate());
        $reps = $exhibition1->getRelations()->getRepresentations();
        assertEquals(2, count($reps));
        assertEquals("REPID_01", $exhibition1->getRelations()->getRepresentation(1)->getREPID());

        $exhibition2 = Store::exhibitionStore()->select(2);
        assertEquals("2020-12", $exhibition2->getDate());
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
        if (!empty($representations)) {
            $work1->getRelations()->addRepresentation($representations[1]);
            $work1->getRelations()->addRepresentation($representations[2]);
        }
        $work1->setDate("2021-12-09");
        $work1->setCreator($creators[2]);
        $work2 = new Work(new WorkDo(null, "RESID_02", "title02", "titel02"));
        if (!empty($representations)) {
            $work2->getRelations()->addRepresentation($representations[3]);
            $work2->getRelations()->addRepresentation($representations[2]);
        }
        $work2->setCreator($creators[1]);
        return Store::workStore()->persistBatch([$work1, $work2]);
    }

    /**
     * @throws Exception
     */
    private function makeExhibitions(array $representations): array {
        $exhibition1 = new Exhibition(new ExhibitionDo(null, "EXHID_01", "6 x 7"));
        $exhibition1->getRelations()->addRepresentation($representations[1]);
        $exhibition1->getRelations()->addRepresentation($representations[3]);
        $exhibition1->setDate("2020");

        $exhibition2 = new Exhibition(new ExhibitionDo(null, "EXHID_02", "The White Aeroplane"));
        $exhibition2->getRelations()->addRepresentation($representations[2]);
        $exhibition2->setDate("2020-12");
        return Store::exhibitionStore()->persistBatch([$exhibition1, $exhibition2]);
    }

    /**
     * @throws Exception
     */
    public function testDeleteCreator() {
        $creators = $this->makeCreators();
        $representations = $this->makeRepresentations();
        $this->makeWorks($representations, $creators);

        $creator = Store::creatorStore()->selectByCRID("CRID_02");
        $work = $creator->getWorks()[1];
        assertEquals($creator, $work->getCreator());
        assertEquals("RESID_01", $work->getRESID());
        assertEquals(0, Store::creatorStore()->delete($creator->getID()));
        assertEquals("Creator:2 has 1 Works and cannot be deleted", Store::creatorStore()->getLastMessage());

        $work->setCreator(null);
        Store::workStore()->persist($work);
        assertEquals(1, Store::creatorStore()->delete($creator->getID()));
        assertFalse(Store::creatorStore()->getLastMessage());
        assertFalse(Store::creatorStore()->selectByCRID("CRID_02"));
    }

    /**
     * @throws Exception
     */
    public function testDeleteWorkWithCreator() {
        $creators = $this->makeCreators();
        $representations = [];
        $this->makeWorks($representations, $creators);

        $work = Store::workStore()->selectByRESID("RESID_01");
        $creator = $work->getCreator();
        assertEquals("CRID_02", $creator->getCRID());
        $count = Store::workStore()->delete($work->getID());
        assertEquals(1, $count);
        assertEmpty($creator->getWorks());
    }

    /**
     * @throws Exception
     */
    public function testDeleteRepresentation() {
        $creators = $this->makeCreators();
        $representations = $this->makeRepresentations();
        $this->makeWorks($representations, $creators);

        $representation1 = Store::representationStore()->select(1);
        $works = $representation1->getRelations()->getWorks();
        assertEquals(1, count($works));
        $work = $works[1];
        assertEquals(Store::representationStore()->select(1),
            $work->getRelations()->getRepresentation(1));

        $result = Store::representationStore()->delete(1);
        assertEquals(0, $result);
        assertEquals("Representation:1 is owned by 1 Works and cannot be deleted",
            Store::representationStore()->getLastMessage());

        $work->getRelations()->removeRepresentation(1);
        Store::workStore()->persist($work);
        assertEquals(1, Store::representationStore()->delete(1));
        assertFalse(Store::representationStore()->select(1));
    }

    public function testDeleteWorkWithRepresentation() {
        $creators = $this->makeCreators();
        $representations = $this->makeRepresentations();
        $this->makeWorks($representations, $creators);

        $work = Store::workStore()->select(1);
        $representation = $work->getRelations()->getRepresentation(1);
        assertEquals("REPID_01", $representation->getREPID());
        assertEquals(1, $representation->getRelations()->getWork(1)->getID());

        assertEquals(1, Store::workStore()->delete(1));
        $representation = Store::representationStore()->select(1);
        assertEmpty($representation->getRelations()->getWorks());
    }

}
