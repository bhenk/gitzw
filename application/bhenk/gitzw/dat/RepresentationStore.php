<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\model\ProgressListener;
use bhenk\logger\log\Log;
use Exception;
use function array_map;
use function array_values;
use function count;
use function gettype;
use function intval;
use function is_int;
use function is_null;
use function is_string;
use function str_repeat;
use function substr;

/**
 * Store for obtaining and persisting Representations
 */
class RepresentationStore implements StoreInterface {
    use RulesTrait;

    const SERIALIZATION_DIRECTORY = "representations";

    /**
     * Persist the given Representation
     *
     * The {@link Representation} is inserted or updated.
     *
     * @param Representation $representation the Representation to persist
     * @return Representation the Representation after persistence (including Primary Id)
     * @throws Exception
     */
    public function persist(Representation $representation): Representation {
        if (is_null($representation->getID())) {
            return $this->insert($representation);
        } else {
            return $this->update($representation);
        }
    }

    /**
     * @throws Exception
     */
    private function insert(Representation $representation): Representation {
        /** @var RepresentationDo $representationDo */
        $representationDo = Dao::representationDao()->insert($representation->getRepresentationDo());
        return new Representation($representationDo);
    }

    /**
     * @throws Exception
     */
    private function update(Representation $representation): Representation {
        Dao::representationDao()->update($representation->getRepresentationDo());
        return $representation;
    }

    /**
     * @param Representation[] $representations
     * @return Representation[]
     * @throws Exception
     */
    public function persistBatch(array $representations): array {
        $inserts = [];
        $updates = [];
        foreach ($representations as $representation) {
            if (is_null($representation->getID())) {
                $inserts[] = $representation->getRepresentationDo();
            } else {
                $updates[$representation->getID()] = $representation->getRepresentationDo();
            }
        }
        $inserted = Dao::representationDao()->insertBatch($inserts);
        Dao::representationDao()->updateBatch($updates);
        $new_representations = [];
        foreach ($updates as $updateDo) {
            $new_representations[$updateDo->getID()] = new Representation($updateDo);
        }
        /** @var RepresentationDo $insertedDo */
        foreach ($inserted as $insertedDo) {
            $new_representations[$insertedDo->getID()] = new Representation($insertedDo);
        }
        return $new_representations;
    }

    /**
     * Try and get the Representation
     *
     * @param int|string|Representation $representation Representation ID (int),
     *    Representation REPID (string)
     *    or Representation (object)
     * @return bool|Representation the Representation or *false* if Representation with ID not in store
     * @throws Exception
     */
    public function get(int|string|Representation $representation): bool|Representation {
        if ($representation instanceof Representation) return $representation;
        if (gettype($representation) == "integer") return $this->select($representation);
        if (gettype($representation) == "string") return $this->selectByREPID($representation);
        return false;
    }

    /**
     * Select the Representation with the given ID
     *
     * @param int $ID Representation ID
     * @return bool|Representation Representation or *false* if Representation with ID not in store
     * @throws Exception
     */
    public function select(int $ID): bool|Representation {
        /** @var RepresentationDo $do */
        $do = Dao::representationDao()->select($ID);
        if ($do) return new Representation($do);
        return false;
    }

    /**
     * Select the Representation with the alternative ID REPID
     *
     * @param string $REPID alternative Representation ID
     * @return bool|Representation Representation or *false* if Representation with REPID not in store
     * @throws Exception
     */
    public function selectByREPID(string $REPID): bool|Representation {
        $arr = Dao::representationDao()->selectWhere("REPID='" . $REPID . "'");
        if (count($arr) == 1) return new Representation(array_values($arr)[0]);
        if (count($arr) > 1) Log::warning("REPID not unique: " . $REPID);
        if (count($arr) == 0) Log::warning("REPID not found: " . $REPID);
        return false;
    }

    /**
     * Select Representations with a where-clause
     *
     * @param string $where expression
     * @param int $offset start index
     * @param int $limit maximum number of representations to return
     * @return Representation[] array of Representations or empty array if end of storage reached
     * @throws Exception
     */
    public function selectWhere(string $where, int $offset = 0, int $limit = PHP_INT_MAX): array {
        /** @var RepresentationDo[] $dos */
        $dos = Dao::representationDao()->selectWhere($where, $offset, $limit);
        return $this->make($dos);
    }

    /**
     * @param array $repids array with
     * @param int $offset
     * @param int $limit
     * @return Representation[]
     * @throws Exception
     */
    public function selectBatchByRepid(array $repids, int $offset = 0, int $limit = PHP_INT_MAX): array {
        $where = "";
        foreach ($repids as $repid) {
            $where .= " OR REPID='$repid'";
        }
        if (empty($where)) return [];
        $where = substr($where, 4);
        return $this->selectWhere($where, $offset, $limit);
    }

    /**
     * Select Representations with given IDs
     *
     * @param int[] $IDs Representation IDs
     * @return Representation[] array of stored Representations
     * @throws Exception
     */
    public function selectBatch(array $IDs): array {
        /** @var RepresentationDo[] $dos */
        $dos = Dao::representationDao()->selectBatch($IDs);
        return $this->make($dos);
    }

    /**
     * Select representations and order by year in RESID
     *
     * @param string $where
     * @param int $offset
     * @param int $limit
     * @param bool $desc
     * @return Representation[]
     * @throws Exception
     */
    public function orderByYear(string $where, int $offset = 0, int $limit = 10, bool $desc = false): array {
        $order = $desc ? "DESC" : "ASC";
        $sql = "SELECT * FROM " . Dao::representationDao()->getTableName()
                . " WHERE $where ORDER BY REPID $order"
                . " LIMIT $offset, $limit;";
        Log::info($sql);
        /** @var RepresentationDo[] $dos */
        $dos = Dao::representationDao()->selectSql($sql);
        return $this->make($dos);
    }

    /**
     * Delete a Representation
     * @param int|string|Representation $representation
     * @return int count of deleted Representations
     * @throws Exception
     */
    public function delete(int|string|Representation $representation): int {
        $this->resetMessages();
        $representation = $this->representationCanBeDeleted($representation);
        if ($representation) {
            Log::info("Delete Representation:" . $representation->getID());
            return Dao::representationDao()->delete($representation->getID());
        }
        return 0;
    }

    /**
     * Delete Representations with a where-clause
     *
     * This method filters Representations that can be deleted.
     *
     * See {@link RulesTrait::getLastMessage()} for reasons.
     *
     * @param string $where expression
     * @return int count of deleted Representations
     * @throws Exception
     */
    public function deleteWhere(string $where): int {
        $representations = $this->selectWhere($where);
        return $this->deleteBatch($representations);
    }

    /**
     * Delete Representations
     *
     * This method filters Representations that can be deleted.
     *
     * See {@link RulesTrait::getLastMessage()} for reasons.
     *
     * @param int[]|string[]|Representation[] $representations Representations to delete
     * @return int count of deleted Representations
     * @throws Exception
     */
    public function deleteBatch(array $representations): int {
        $this->resetMessages();
        $IDs = [];
        foreach ($representations as $representation) {
            $representation = $this->representationCanBeDeleted($representation);
            if ($representation) $IDs[] = $representation->getID();
        }
        return Dao::representationDao()->deleteBatch($IDs);
    }

    /**
     * Count Representations with a where clause
     * @param string $where
     * @return int
     * @throws Exception
     */
    public function countWhere(string $where): int {
        // SELECT COUNT(*) FROM `tbl_representations` WHERE
        $sql = "SELECT COUNT(*) FROM " . Dao::representationDao()->getTableName() . " WHERE " . $where . ";";
        $result = Dao::representationDao()->execute($sql);
        return $result[0]["COUNT(*)"];
    }

    /**
     * Get the name of the serialization directory
     *
     * @see RepresentationStore::SERIALIZATION_DIRECTORY
     * @return string
     */
    public function getName(): string {
        return self::SERIALIZATION_DIRECTORY;
    }

    /**
     * Count Representations
     *
     * Same as {@link RepresentationStore::countWhere()} with $where = "1-1";
     * @return int
     * @throws Exception
     */
    public function getObjectCount(): int {
        return $this->countWhere("1=1");
    }

    /**
     * Get all REPIDs
     * @param string $where
     * @return string[]
     * @throws Exception
     */
    public function getREPIDS(string $where = "1=1"):array {
        $sql = "SELECT `REPID` FROM " . Dao::representationDao()->getTableName()
            . " WHERE " . $where . " ORDER BY `REPID`;";
        return array_map(function($x) {
            return $x["REPID"];
        }, Dao::representationDao()->execute($sql));
    }

    public function getREPIDsByFilterSql(string|bool $source,
                                      int|bool    $hidden,
                                      int|bool    $carousel,
                                      int         $operator = 11): string {
        //SELECT r.REPID FROM tbl_representations r
        //INNER JOIN tbl_work_rep wr ON r.ID = wr.FK_RIGHT
        //WHERE r.source="MP250 series" AND/OR wr.hidden = 0 AND/OR wr.carousel = 1;
        $tnr = Dao::representationDao()->getTableName();
        $tnwr = Dao::workHasRepDao()->getTableName();
        $op1 = ($operator >= 10) ? " AND" : " OR";
        $op2 = (($operator % 10) == 1 ) ? " AND" : " OR";
        $src = "";
        if (is_string($source)) $src = " $source";
        if (!empty($src)) $src .= (is_int($hidden) || is_int($carousel)) ? $op1 : "";
        $hdn = (is_int($hidden)) ? (" wr.hidden=$hidden" . ((is_int($carousel)) ? $op2 : "")) : "";
        $csl = (is_int($carousel)) ? " wr.carousel=$carousel" : "";
        $whr = empty("$src$hdn$csl") ? ";" : "\nWHERE$src$hdn$csl;";
        return "SELECT r.REPID FROM $tnr r"
            . "\nINNER JOIN $tnwr wr ON r.ID = wr.FK_RIGHT"
            . "$whr";
    }

    public function getREPIDsByFilter(string|bool|null $source,
                                         int|bool    $hidden,
                                         int|bool    $carousel,
                                         int         $operator = 11): array {
        $sql = $this->getREPIDsByFilterSql($source, $hidden, $carousel, $operator);
        return array_map(function($x) {
            return $x["REPID"];
        }, Dao::representationDao()->execute($sql));
    }

    /**
     * Get orphan REPIDs from Work AND Exhibitions or either of them
     *
     * @param bool $orphanWork true for selecting orphans from Work
     * @param bool $orphanExh true for selecting orphans from Exhibitions
     * @return string[]
     * @throws Exception
     */
    public function getOrphanREPIDs(bool $orphanWork = true, bool $orphanExh = true): array {
        //SELECT * FROM tbl_representations
        //WHERE ID NOT IN (SELECT FK_RIGHT FROM tbl_work_rep)
        //AND ID NOT IN (SELECT FK_RIGHT FROM tbl_exh_rep);
        $workClause = $orphanWork ? "ID NOT IN (SELECT FK_RIGHT FROM "
            . Dao::workHasRepDao()->getTableName() . ")" : "1=1";
        $exhClause = $orphanExh ? "ID NOT IN (SELECT FK_RIGHT FROM "
            . Dao::exhHasRepDao()->getTableName() . ")" : "1=1";
        $sql = "SELECT REPID FROM " . Dao::representationDao()->getTableName()
            . " WHERE " . $workClause
            . " AND " . $exhClause . ";";
        return array_map(function($x) {
            return $x["REPID"];
        }, Dao::representationDao()->execute($sql));
    }

    public function countByYear(string $where = "1=1"): array {
        //SELECT SUBSTR(REPID, 1, 8) as rep_year, COUNT(*) as count FROM tbl_representations
        //WHERE source = "OpticFilm 8200i"
        //GROUP BY rep_year;
        $sql = "SELECT SUBSTR(REPID, 1, 8) as rep_year, COUNT(*) as count FROM "
            . Dao::representationDao()->getTableName()
            . " WHERE " . $where
            . " GROUP BY rep_year";
        $rows = Dao::representationDao()->execute($sql);
        $result = [];
        foreach ($rows as $row) {
            $result[$row["rep_year"]] = intval($row["count"]);
        }
        return  $result;
    }

    public function countBySource(string $where = "1=1"): array {
        //SELECT source, COUNT(*) as count FROM tbl_representations
        //WHERE YEAR(`date`) = 2021
        //GROUP BY source
        //ORDER BY source;
        $sql = "SELECT source, COUNT(*) as count FROM " . Dao::representationDao()->getTableName()
            . " WHERE " . $where
            . " GROUP BY source ORDER BY source;";
        $rows = Dao::representationDao()->execute($sql);
        $result = [];
        foreach ($rows as $row) {
            $source = empty($row["source"]) ? "NULL" : $row["source"];
            $result[$source] = intval($row["count"]);
        }
        return  $result;
    }

    /**
     * Serialize all the Representations
     * @param string $datastore directory for serialization files
     * @param ProgressListener $pl
     * @return array<string, int> count of serialized representations
     * @throws Exception
     * @noinspection DuplicatedCode
     */
    public function serialize(string $datastore, ProgressListener $pl): array {
        $pl->updateMessage("Serializing Representations");
        $count = 0;
        $offset = 0;
        $limit = 10;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        if (!is_dir($storage)) mkdir($storage);
        array_map('unlink', array_filter((array)glob($storage . DIRECTORY_SEPARATOR . "*")));
        do {
            $representations = $this->selectWhere("1 = 1", $offset, $limit);
            foreach ($representations as $representation) {
                $file = $storage . DIRECTORY_SEPARATOR . "representation_"
                    . sprintf("%05d", $representation->getID()) . ".json";
                file_put_contents($file, $representation->serialize());
                $count++;
                $pl->increase();
            }
            $offset += $limit;
        } while (!empty($representations));
        Log::info("Serialized " . $count . " Representations");
        return [self::SERIALIZATION_DIRECTORY => $count];
    }


    /**
     * Deserialize from serialization files and store Representations
     * @param string $datastore directory where to find serialization files
     * @param ProgressListener $pl
     * @return array<string, int> count of deserialized representations
     * @throws Exception
     */
    public function deserialize(string $datastore, ProgressListener $pl): array {
        $pl->updateMessage("Deserializing Representations");
        $count = 0;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        $filenames = array_diff(scandir($storage), array("..", ".", ".DS_Store"));
        foreach ($filenames as $filename) {
            $representation = Representation::deserialize(
                file_get_contents($storage . DIRECTORY_SEPARATOR . $filename));
            Dao::representationDao()->insert($representation->getRepresentationDo(), true);
            $count++;
            $pl->increase();
        }
        Log::info("Deserialized " . $count . " Representations");
        return [self::SERIALIZATION_DIRECTORY => $count];
    }

    /**
     * @param RepresentationDo[] $dos
     * @return Representation[]
     */
    private function make(array $dos): array {
        $representations = [];
        foreach ($dos as $do) {
            $representations[$do->getID()] = new Representation($do);
        }
        return $representations;
    }

}