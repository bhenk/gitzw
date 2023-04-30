<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\model\WorkCategories;
use bhenk\logger\log\Log;
use Exception;
use function array_values;
use function count;
use function gettype;
use function is_null;

/**
 * Store for obtaining and persisting Works
 */
class WorkStore {
    use RulesTrait;

    const SERIALIZATION_DIRECTORY = "works";

    /**
     * Persist the given Work
     *
     * The {@link Work} is inserted or updated. {@link WorkRelations} of the Work are
     * inserted, updated or deleted.
     *
     * @param Work $work the Work to persist
     * @return Work the Work after persistence (includes Primary ID)
     * @throws Exception
     */
    public function persist(Work $work): Work {
        if (is_null($work->getID())) {
            return $this->ingest($work);
        } else {
            return $this->update($work);
        }
    }

    /**
     * @param Work $work
     * @return Work
     * @throws Exception
     */
    private function ingest(Work $work): Work {
        /** @var WorkDo $do */
        $do = Dao::workDao()->insert($work->getWorkDo());
        $relations = $work->getRelations();
        $relations->persist($do->getID());
        return new Work($do);
    }

    /**
     * @param Work $work
     * @return Work
     * @throws Exception
     */
    private function update(Work $work): Work {
        Dao::workDao()->update($work->getWorkDo());
        $relations = $work->getRelations();
        $relations->persist($work->getID());
        return new Work($work->getWorkDo());
    }

    /**
     * @param Work[] $works
     * @return Work[]
     * @throws Exception
     */
    public function persistBatch(array $works): array {
        $results = [];
        foreach ($works as $work) {
            if (is_null($work->getID())) {
                $newWork = $this->ingest($work);
            } else {
                $newWork = $this->update($work);
            }
            $results[$newWork->getID()] = $newWork;
        }
        return $results;
    }

    /**
     * Select Works by Creator
     * @param int|string|Creator $creator creatorID, CRID or Creator
     * @param int $offset start index
     * @param int $limit max number of Works to return
     * @return array<int, Work> array of Works or empty array if end of storage reached
     * @throws Exception
     */
    public function selectByCreator(int|string|Creator $creator,
                                    int                $offset = 0,
                                    int                $limit = PHP_INT_MAX): array {
        $c = Store::creatorStore()->get($creator);
        if ($c) {
            $creatorID = $c->getID();
            if (!is_null($creatorID)) {
                return $this->selectWhere("creatorId=" . $creatorID, $offset, $limit);
            }
        }
        return [];
    }

    /**
     * @param int|string|Work $work
     * @return bool|Work
     * @throws Exception
     */
    public function get(int|string|Work $work): bool|Work {
        if ($work instanceof Work) return $work;
        if (gettype($work) == "integer") return $this->select($work);
        if (gettype($work) == "string") return $this->selectByRESID($work);
        return false;
    }

    /**
     * Select Work with given ID
     * @param int $ID
     * @return bool|Work
     * @throws Exception
     */
    public function select(int $ID): bool|Work {
        /** @var WorkDo $do */
        $do = Dao::workDao()->select($ID);
        if ($do) return new Work($do);
        return false;
    }

    /**
     * Select Work with given alternative RESID
     * @param string $RESID
     * @return bool|Work
     * @throws Exception
     */
    public function selectByRESID(string $RESID): bool|Work {
        $arr = Dao::workDao()->selectWhere("RESID='" . $RESID . "'");
        if (count($arr) == 1) return new Work(array_values($arr)[0]);
        return false;
    }

    /**
     * Select Works with a where-clause
     * @param string $where expression
     * @param int $offset start index
     * @param int $limit max number of Works to return
     * @return array<int, Work> array of Works or empty array if end of storage reached
     * @throws Exception
     */
    public function selectWhere(string $where, int $offset = 0, int $limit = PHP_INT_MAX): array {
        $resources = [];
        $dos = Dao::workDao()->selectWhere($where, $offset, $limit);
        /** @var WorkDo $do */
        foreach ($dos as $do) {
            $resources[$do->getID()] = new Work($do);
        }
        return $resources;
    }

    /**
     * Select Works with given IDs
     *
     * @param int[] $IDs Work IDs
     * @return Work[] array of stored Works
     * @throws Exception
     */
    public function selectBatch(array $IDs): array {
        $resources = [];
        $dos = Dao::workDao()->selectBatch($IDs);
        /** @var WorkDo $do */
        foreach ($dos as $do) {
            $resources[$do->getID()] = new Work($do);
        }
        return $resources;
    }

    /**
     * Delete Works
     * @param array $works IDs, RESIDs or Works to delete
     * @return int count of deleted Works
     * @throws Exception
     */
    public function deleteBatch(array $works): int {
        $this->resetMessages();
        $count = 0;
        foreach ($works as $work) {
            $count += $this->delete($work, false);
        }
        return $count;
    }

    /**
     * Delete a Work
     * @param int|string|Work $work
     * @param bool $resetMessages
     * @return int rows affected
     * @throws Exception
     */
    public function delete(int|string|Work $work, bool $resetMessages = true): int {
        if ($resetMessages) $this->resetMessages();
        $work = $this->workCanBeDeleted($work);
        if (!$work) return 0;
        Dao::workHasRepDao()->deleteWhere("FK_LEFT=" . $work->getID());
        return Dao::workDao()->delete($work->getID());
    }

    /**
     * Delete Works with a where-clause
     * @param string $where expression
     * @return int count of deleted Works
     * @throws Exception
     */
    public function deleteWhere(string $where): int {
        $works = Store::workStore()->selectWhere($where);
        return $this->deleteBatch($works);
    }

    /**
     * @param int $year
     * @param WorkCategories $cat
     * @param string $owner
     * @return array
     * @throws Exception
     */
    public function selectRESIDsWhere(int           $year,
                                     WorkCategories $cat,
                                     string         $owner = "hnq"): array {
        // Select RESID from tbl_works where RESID like 'hnq.work.draw.2020.%' order by RESID;
        $sql = /** @lang text */
            "SELECT RESID from " . Dao::workDao()->getTableName()
            . " where RESID like '$owner.work.$cat->name.$year.%' order by RESID;";
        $resids = [];
        foreach (Dao::workDao()->execute($sql) as $row) {
            $resids[] = $row["RESID"];
        }
        return $resids;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function countByCategory(): array {
        // SELECT category_id, COUNT(*) FROM product_details GROUP BY category_id;
        $sql = /** @lang text */
            "SELECT category, COUNT(*) from " . Dao::workDao()->getTableName() . " GROUP BY category;";
        $result = Dao::workDao()->execute($sql);
        $catCount = [];
        foreach ($result as $item) {
            $catCount[$item["category"]] = $item["COUNT(*)"];
        }
        return $catCount;
    }

    /**
     * Serialize all the Works
     * @param string $datastore directory for serialization files
     * @return array [count of serialized works, count of serialized relations]
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
                $file = $storage . DIRECTORY_SEPARATOR . "work_"
                    . sprintf("%05d", $resource->getID()) . ".json";
                file_put_contents($file, $resource->serialize());
                $count++;
                $countRelations += count($resource->getRelations()->getRepRelations());
            }
            $offset += $limit;
        } while (!empty($resources));
        Log::info("Serialized " . $count . " Works");
        return [$count, $countRelations];
    }

    /**
     * Deserialize from serialization files and store Works and WorkRelations
     * @param string $datastore directory where to find serialization files
     * @return array array[count of deserialized works, count of deserialized relations]
     * @throws Exception
     */
    public function deserialize(string $datastore): array {
        $count = 0;
        $relationCount = 0;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        $filenames = array_diff(scandir($storage), array("..", ".", ".DS_Store"));
        foreach ($filenames as $filename) {
            $resource = Work::deserialize(
                file_get_contents($storage . DIRECTORY_SEPARATOR . $filename));
            Dao::workDao()->insert($resource->getWorkDo(), true);
            $relationCount += $resource->getRelations()->deserialize();
            $count++;
        }
        return [$count, $relationCount];
    }

}