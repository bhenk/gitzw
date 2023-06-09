<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\model\ProgressListener;
use bhenk\gitzw\model\WorkCategories;
use bhenk\logger\log\Log;
use Closure;
use Exception;
use function array_map;
use function array_values;
use function count;
use function gettype;
use function intval;
use function is_null;
use function str_pad;
use function strlen;
use function substr;

/**
 * Store for obtaining and persisting Works
 */
class WorkStore implements StoreInterface {
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
     * Select the nearest row from *$ID* going down
     *
     * @param int $ID
     * @return Work
     * @throws Exception
     */
    public function selectNearestDown(int $ID): Work {
        //select * from tbl_works where ID = (select min(ID) from tbl_works where ID > 197)
        $where = "ID = (select min(ID) from tbl_works where ID > $ID)";
        $down_array = $this->selectWhere($where);
        if (empty($down_array)) {
            $where = "ID = (select min(ID) from tbl_works where ID > -1)";
            $down_array = $this->selectWhere($where);
        }
        return array_values($down_array)[0];
    }

    /**
     * Select the nearest row from *$ID* going up
     * @param int $ID
     * @return Work
     * @throws Exception
     */
    public function selectNearestUp(int $ID): Work {
        $where = "ID = (select max(ID) from tbl_works where ID < $ID)";
        $up_array = $this->selectWhere($where);
        if (empty($up_array)) {
            $where = "ID = (select max(ID) from tbl_works where ID < 999999999)";
            $up_array = $this->selectWhere($where);
        }
        return array_values($up_array)[0];
    }

    public function selectNearestUpByOrder(int $order, bool $showHidden = false): Work {
        $where = $showHidden ? "" : "hidden = 0 AND ";
        $where .= "`ordering` < $order ORDER BY `ordering` DESC";
        $down_array = $this->selectWhere($where, 0, 1);
        if (empty($down_array)) {
            $where = "`ordering` < " . PHP_INT_MAX . " ORDER BY `ordering` DESC";
            $down_array = $this->selectWhere($where, 0, 1);
        }
        return array_values($down_array)[0];
    }

    public function selectNearestDownByOrder(int $order, bool $showHidden = false): Work {
        $where = $showHidden ? "" : "hidden = 0 AND ";
        $where .= "`ordering` > $order ORDER BY `ordering` ASC";
        $up_array = $this->selectWhere($where, 0, 1);
        if (empty($up_array)) {
            $where = "`ordering` > 0 ORDER BY `ordering` ASC";
            $up_array = $this->selectWhere($where, 0, 1);
        }
        return array_values($up_array)[0];
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
            . " WHERE RESID like '$owner.work.$cat->name.$year.%' order by RESID;";
        $resids = [];
        foreach (Dao::workDao()->execute($sql) as $row) {
            $resids[] = $row["RESID"];
        }
        return $resids;
    }

    /**
     * Get the next RESID
     *
     * @param int $year
     * @param WorkCategories $cat
     * @param string $owner
     * @return string|bool next RESID or *false* if value of parameters not accepted
     * @throws Exception
     */
    public function nextRESID(int $year, WorkCategories $cat, string $owner): string|bool {
        $resids = $this->selectRESIDsWhere($year, $cat, $owner);
        if (empty($resids)) {
            if (strlen($owner) != 3) return false;
            if ($year < 1000 || $year > 9999) return false;
            return "$owner.work.$cat->name.$year.0000";
        } else {
            $last = end($resids);
            $number = intval(substr($last, -4));
            $next = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            return "$owner.work.$cat->name.$year.$next";
        }
    }

    public function countWhere(string $where): int {
        // SELECT COUNT(*) FROM `tbl_works` WHERE
        $sql = "SELECT COUNT(*) FROM " . Dao::workDao()->getTableName() . " WHERE " . $where . ";";
        $result = Dao::workDao()->execute($sql);
        return $result[0]["COUNT(*)"];
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
     * Select category, year for given creator shortCRID
     * @param string $shortCrid
     * @param bool $showHidden
     * @return array
     * @throws Exception
     */
    public function selectCatYear(string $shortCrid, bool $showHidden = false): array {
        $hidden = $showHidden ? "" : " AND `hidden` = 0 ";
        $sql = "SELECT category, YEAR(date) as `year` from tbl_works "
            . "where RESID like '$shortCrid.%' $hidden"
            . "GROUP BY category, `year` "
            . "ORDER BY category, `year` DESC";
        return Dao::workDao()->execute($sql);
    }

    public function getCategories(string $where, bool $showHidden = false): array {
        // SELECT DISTINCT `category` FROM tbl_works WHERE `creatorId`=1 [AND `hidden`=0]
        $hidden = $showHidden ? ";" : " AND `hidden`=0;";
        $sql = "SELECT DISTINCT `category` FROM " . Dao::workDao()->getTableName()
            . " WHERE " . $where . $hidden;
        $names = Dao::workDao()->execute($sql);
        return array_map(function ($x) {
            return WorkCategories::forName($x["category"]);
        }, $names);
    }

    /**
     * Iterate all Works in result of $where and offer each work to $func
     *
     * The given $sql must 'SELECT * FROM tbl_works ... '
     * @param Closure $func
     * @param string $where
     * @return void
     * @throws Exception
     */
    public function iterate(Closure $func, string $where): void {
        $offset = 0;
        $limit = 10;
        $count = 1;
        do {
            $works = $this->selectWhere($where, $offset, $limit);
            foreach ($works as $work) {
                $func($count++, $work);
                $this->persist($work);
            }
            $offset += $limit;
        } while (!empty($works));
    }

    public function getName(): string {
        return self::SERIALIZATION_DIRECTORY;
    }

    public function getObjectCount(): int {
        return $this->countWhere("1=1");
    }

    /**
     * Serialize all the Works
     * @param string $datastore directory for serialization files
     * @param ProgressListener $pl
     * @return array<string, int>
     * @throws Exception
     * @noinspection DuplicatedCode
     */
    public function serialize(string $datastore, ProgressListener $pl): array {
        $pl->updateMessage("Serializing Works");
        $count = 0;
        $countRelations = 0;
        $offset = 0;
        $limit = 10;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        if (!is_dir($storage)) mkdir($storage);
        array_map('unlink', array_filter((array)glob($storage . DIRECTORY_SEPARATOR . "*")));
        do {
            $works = $this->selectWhere("1 = 1", $offset, $limit);
            foreach ($works as $resource) {
                $file = $storage . DIRECTORY_SEPARATOR . "work_"
                    . sprintf("%05d", $resource->getID()) . ".json";
                file_put_contents($file, $resource->serialize());
                $count++;
                $countRelations += count($resource->getRelations()->getRepRelations());
                $pl->increase();
            }
            $offset += $limit;
        } while (!empty($works));
        Log::info("Serialized " . $count . " Works, " . $countRelations . " relations");
        return [self::SERIALIZATION_DIRECTORY => $count, "work_relations" => $countRelations];
    }

    /**
     * Deserialize from serialization files and store Works and WorkRelations
     * @param string $datastore directory where to find serialization files
     * @param ProgressListener $pl
     * @return array<string, int>
     * @throws Exception
     */
    public function deserialize(string $datastore, ProgressListener $pl): array {
        $pl->updateMessage("Deserializing Works");
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
            $pl->increase();
        }
        Log::info("Deserialized " . $count . " Works, " . $relationCount . " relations");
        return [self::SERIALIZATION_DIRECTORY => $count, "work_relations" => $relationCount];
    }

}