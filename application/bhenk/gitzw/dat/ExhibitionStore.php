<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ExhibitionDo;
use bhenk\logger\log\Log;
use Exception;

/**
 * Store for obtaining and persisting Exhibitions
 */
class ExhibitionStore {

    const SERIALIZATION_DIRECTORY = "exhibitions";

    /**
     * Persist the given Exhibition
     *
     * The {@link Exhibition} is inserted or updated. {@link ExhibitionRelations} of the Exhibition are
     * inserted, updated or deleted.
     *
     * @param Exhibition $exhibition the Exhibition to persist
     * @return Exhibition the Exhibition after persistence (includes Primary ID)
     * @throws Exception
     */
    public function persist(Exhibition $exhibition): Exhibition {
        if (is_null($exhibition->getID())) {
            return $this->ingest($exhibition);
        } else {
            return $this->update($exhibition);
        }
    }

    /**
     * @param Exhibition $exhibition
     * @return Exhibition
     * @throws Exception
     */
    private function ingest(Exhibition $exhibition): Exhibition {
        /** @var ExhibitionDo $do */
        $do = Dao::exhibitionDao()->insert($exhibition->getExhibitionDo());
        $relations = $exhibition->getRelations();
        $relations->persist($do->getID());
        return new Exhibition($do);
    }

    /**
     * @param Exhibition $exhibition
     * @return Exhibition
     * @throws Exception
     */
    private function update(Exhibition $exhibition): Exhibition {
        Dao::exhibitionDao()->update($exhibition->getExhibitionDo());
        $relations = $exhibition->getRelations();
        $relations->persist($exhibition->getID());
        return new Exhibition($exhibition->getExhibitionDo());
    }

    /**
     * @param Exhibition[] $exhibitions
     * @return Exhibition[]
     * @throws Exception
     */
    public function persistBatch(array $exhibitions): array {
        $results = [];
        foreach ($exhibitions as $exhibition) {
            if (is_null($exhibition->getID())) {
                $newExhibition = $this->ingest($exhibition);
            } else {
                $newExhibition = $this->update($exhibition);
            }
            $results[$newExhibition->getID()] = $newExhibition;
        }
        return $results;
    }

    /**
     * Select Exhibitions with given IDs
     *
     * @param int[] $IDs Exhibition IDs
     * @return Exhibition[] array of stored Exhibitions
     * @throws Exception
     */
    public function selectBatch(array $IDs): array {
        $exhibitions = [];
        $dos = Dao::exhibitionDao()->selectBatch($IDs);
        /** @var ExhibitionDo $do */
        foreach ($dos as $do) {
            $exhibitions[$do->getID()] = new Exhibition($do);
        }
        return $exhibitions;
    }

    /**
     * Delete Exhibitions
     * @param array $exhibitions IDs, RESIDs or Exhibitions to delete
     * @return int count of deleted Exhibitions
     * @throws Exception
     */
    public function deleteBatch(array $exhibitions): int {
        $count = 0;
        foreach ($exhibitions as $exhibition) {
            $count += $this->delete($exhibition);
        }
        return $count;
    }

    /**
     * Delete a Exhibition
     * @param int|string|Exhibition $exhibition
     * @return int rows affected
     * @throws Exception
     */
    public function delete(int|string|Exhibition $exhibition): int {
        $exhibition = $this->get($exhibition);
        if ($exhibition) {
            if (!is_null($exhibition->getID())) {
                Dao::exhHasRepDao()->deleteWhere("FK_LEFT=" . $exhibition->getID());
                return Dao::exhibitionDao()->delete($exhibition->getID());
            }
        }
        return 0;
    }

    /**
     * @param int|string|Exhibition $exhibition
     * @return bool|Exhibition
     * @throws Exception
     */
    public function get(int|string|Exhibition $exhibition): bool|Exhibition {
        if ($exhibition instanceof Exhibition) return $exhibition;
        if (gettype($exhibition) == "integer") return $this->select($exhibition);
        if (gettype($exhibition) == "string") return $this->selectByEXHID($exhibition);
        return false;
    }

    /**
     * Select Exhibition with given ID
     * @param int $ID
     * @return bool|Exhibition
     * @throws Exception
     */
    public function select(int $ID): bool|Exhibition {
        /** @var ExhibitionDo $do */
        $do = Dao::exhibitionDao()->select($ID);
        if ($do) return new Exhibition($do);
        return false;
    }

    /**
     * Select Exhibition with given alternative EXHID
     * @param string $EXHID
     * @return bool|Exhibition
     * @throws Exception
     */
    public function selectByEXHID(string $EXHID): bool|Exhibition {
        $arr = Dao::exhibitionDao()->selectWhere("EXHID='" . $EXHID . "'");
        if (count($arr) == 1) return new Exhibition(array_values($arr)[0]);
        return false;
    }

    /**
     * Select Exhibitions with a where-clause
     * @param string $where expression
     * @param int $offset start index
     * @param int $limit max number of Exhibitions to return
     * @return array<int, Exhibition> array of Exhibitions or empty array if end of storage reached
     * @throws Exception
     */
    public function selectWhere(string $where, int $offset = 0, int $limit = PHP_INT_MAX): array {
        $exhibitions = [];
        $dos = Dao::exhibitionDao()->selectWhere($where, $offset, $limit);
        /** @var ExhibitionDo $do */
        foreach ($dos as $do) {
            $exhibitions[$do->getID()] = new Exhibition($do);
        }
        return $exhibitions;
    }

    /**
     * Delete Exhibitions with a where-clause
     * @param string $where expression
     * @return int count of deleted Exhibitions
     * @throws Exception
     */
    public function deleteWhere(string $where): int {
        $exhibitions = Store::exhibitionStore()->selectWhere($where);
        return $this->deleteBatch($exhibitions);
    }

    /**
     * Serialize all the Exhibitions
     * @param string $datastore directory for serialization files
     * @return array [count of serialized exhibitions, count of serialized relations]
     * @throws Exception
     * @noinspection DuplicatedCode
     */
    public function serialize(string $datastore): array {
        $count = 0;
        $countRelations = 0;
        $offset = 0;
        $limit = 10;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        if (!is_dir($storage)) mkdir($storage);
        array_map('unlink', array_filter((array)glob($storage . DIRECTORY_SEPARATOR . "*")));
        do {
            $resources = $this->selectWhere("1 = 1", $offset, $limit);
            foreach ($resources as $resource) {
                $file = $storage . DIRECTORY_SEPARATOR . "exhibition_"
                    . sprintf("%05d", $resource->getID()) . ".json";
                file_put_contents($file, $resource->serialize());
                $count++;
                $countRelations += count($resource->getRelations()->getRepRelations());
            }
            $offset += $limit;
        } while (!empty($resources));
        Log::info("Serialized " . $count . " Exhibitions");
        return [$count, $countRelations];
    }

    /**
     * Deserialize from serialization files and store Exhibitions and ExhibitionRelations
     * @param string $datastore directory where to find serialization files
     * @return array array[count of deserialized exhibitions, count of deserialized relations]
     * @throws Exception
     */
    public function deserialize(string $datastore): array {
        $count = 0;
        $relationCount = 0;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        $filenames = array_diff(scandir($storage), array("..", ".", ".DS_Store"));
        foreach ($filenames as $filename) {
            $resource = Exhibition::deserialize(
                file_get_contents($storage . DIRECTORY_SEPARATOR . $filename));
            Dao::exhibitionDao()->insert($resource->getExhibitionDo(), true);
            $relationCount += $resource->getRelations()->deserialize();
            $count++;
        }
        return [$count, $relationCount];
    }

}