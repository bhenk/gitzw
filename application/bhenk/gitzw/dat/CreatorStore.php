<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\model\ProgressListener;
use bhenk\logger\log\Log;
use Exception;
use function array_diff;
use function array_filter;
use function array_map;
use function array_values;
use function file_get_contents;
use function file_put_contents;
use function glob;
use function is_dir;
use function is_null;
use function mkdir;
use function scandir;
use function sprintf;
use function str_contains;

/**
 * Stores Creators
 *
 */
class CreatorStore implements StoreInterface {
    use RulesTrait;

    const SERIALIZATION_DIRECTORY = "creators";

    /**
     * Persist the given Creator
     *
     * The {@link Creator} is inserted or updated
     *
     * @param Creator $creator the Creator to persist
     * @return Creator the Creator after persistence (includes Primary ID)
     * @throws Exception
     */
    public function persist(Creator $creator): Creator {
        if (is_null($creator->getID())) {
            return $this->ingest($creator);
        } else {
            return $this->update($creator);
        }
    }

    /**
     * @param Creator $creator
     * @return Creator
     * @throws Exception
     */
    private function ingest(Creator $creator): Creator {
        /** @var CreatorDo $do */
        $do = Dao::creatorDao()->insert($creator->getCreatorDo());
        return new Creator($do);
    }

    /**
     * @throws Exception
     */
    private function update(Creator $creator): Creator {
        Dao::creatorDao()->update($creator->getCreatorDo());
        return $creator;
    }

    /**
     * @param Creator[] $creators
     * @return Creator[]
     * @throws Exception
     */
    public function persistBatch(array $creators): array {
        $inserts = [];
        $updates = [];
        foreach ($creators as $creator) {
            if (is_null($creator->getID())) {
                $inserts[] = $creator->getCreatorDo();
            } else {
                $updates[$creator->getID()] = $creator->getCreatorDo();
            }
        }
        $inserted = Dao::creatorDao()->insertBatch($inserts);
        Dao::creatorDao()->updateBatch($updates);
        $new_creators = [];
        foreach ($updates as $updateDo) {
            $new_creators[$updateDo->getID()] = new Creator($updateDo);
        }
        /** @var CreatorDo $insertedDo */
        foreach ($inserted as $insertedDo) {
            $new_creators[$insertedDo->getID()] = new Creator($insertedDo);
        }
        return $new_creators;
    }

    /**
     * Try and get the Creator
     *
     * @param int|string|Creator $creator Creator ID (int),
     *    Creator CRID (string)
     *    or Creator (object)
     * @return bool|Creator the Creator or *false* if Creator with ID not in store
     * @throws Exception
     */
    public function get(int|string|Creator $creator): bool|Creator {
        if ($creator instanceof Creator) return $creator;
        if (gettype($creator) == "integer") return $this->select($creator);
        if (gettype($creator) == "string") return $this->selectByCRID($creator);
        return false;
    }

    /**
     * Select the Creator with the given ID
     *
     * @param int $ID Creator ID
     * @return bool|Creator Creator or *false* if Creator with ID not in store
     * @throws Exception
     */
    public function select(int $ID): bool|Creator {
        /** @var CreatorDo $do */
        $do = Dao::creatorDao()->select($ID);
        if ($do) return new Creator($do);
        return false;
    }

    /**
     * Select the Creator with the alternative ID CRID
     *
     * @param string $CRID alternative Creator ID
     * @return bool|Creator Creator or *false* if Creator with CRID not in store
     * @throws Exception
     */
    public function selectByCRID(string $CRID): bool|Creator {
        $arr = Dao::creatorDao()->selectWhere("CRID='" . $CRID . "'");
        if (count($arr) == 1) return new Creator(array_values($arr)[0]);
        if (count($arr) > 1) Log::warning("CRID not unique: " . $CRID);
        return false;
    }

    /**
     * Select Creators with a where-clause
     *
     * @param string $where expression
     * @param int $offset start index
     * @param int $limit maximum number of creators to return
     * @return Creator[] array of Creators or empty array if end of storage reached
     * @throws Exception
     */
    public function selectWhere(string $where, int $offset = 0, int $limit = PHP_INT_MAX): array {
        $creators = [];
        $dos = Dao::creatorDao()->selectWhere($where, $offset, $limit);
        /** @var CreatorDo $do */
        foreach ($dos as $do) {
            $creators[$do->getID()] = new Creator($do);
        }
        return $creators;
    }

    /**
     * Select Creators with given IDs
     *
     * @param int[] $IDs Creator IDs
     * @return Creator[] array of stored Creators
     * @throws Exception
     */
    public function selectBatch(array $IDs): array {
        $creators = [];
        $dos = Dao::creatorDao()->selectBatch($IDs);
        /** @var CreatorDo $do */
        foreach ($dos as $do) {
            $creators[$do->getID()] = new Creator($do);
        }
        return $creators;
    }

    /**
     * Delete a Creator
     * @param int|string|Creator $creator
     * @return int count of deleted Creators
     * @throws Exception
     */
    public function delete(int|string|Creator $creator): int {
        $this->resetMessages();
        $creator = $this->creatorCanBeDeleted($creator);
        if (!$creator) return 0;
        return Dao::creatorDao()->delete($creator->getID());
    }

    /**
     * Delete Creators with a where-clause
     * @param string $where expression
     * @return int count of deleted Creators
     * @throws Exception
     */
    public function deleteWhere(string $where): int {
        $creators = Store::creatorStore()->selectWhere($where);
        return $this->deleteBatch($creators);
    }

    /**
     * Delete Creators
     *
     * This method filters Creators before deletion on rules for creator deletion
     *
     * @param int[]|string[]|Creator[] $creators can be mixed array
     * @return int count of deleted Creators
     * @throws Exception
     */
    public function deleteBatch(array $creators): int {
        $this->resetMessages();
        $IDs = [];
        foreach ($creators as $creator) {
            $creator = $this->creatorCanBeDeleted($creator);
            if ($creator) $IDs[] = $creator->getID();
        }
        return Dao::creatorDao()->deleteBatch($IDs);
    }

    /**
     * Select a creator by name
     *
     * Discovers name in *CRID* or *url*. Creates where-clause as one of
     *
     * ```
     *    CRID='{http_url}/{CRID}'
     *    url='{https_url}/{full-name}'
     * ```
     * Decides which on presence of "-" in $name.
     *
     * @param string $name
     * @return bool|Creator
     * @throws Exception
     */
    public function selectByName(string $name): bool|Creator {
        $where = "CRID='http://gitzw.art/$name'";
        if (str_contains($name, "-")) $where = "url='https://gitzw.art/$name'";
        $creators = $this->selectWhere($where);
        return array_values($creators)[0] ?? false;
    }

    public function countWhere(string $where): int {
        // SELECT COUNT(*) FROM `tbl_creators` WHERE
        $sql = "SELECT COUNT(*) FROM " . Dao::creatorDao()->getTableName() . " WHERE " . $where . ";";
        $result = Dao::creatorDao()->execute($sql);
        return $result[0]["COUNT(*)"];
    }

    public function getName(): string {
        return self::SERIALIZATION_DIRECTORY;
    }

    public function getObjectCount(): int {
        return $this->countWhere("1=1");
    }

    /**
     * Serialize all the Creators
     * @param string $datastore directory for serialization files
     * @param ProgressListener $pl
     * @return array<string, int> count of serialized creators
     * @throws Exception
     * @noinspection DuplicatedCode
     */
    public function serialize(string $datastore, ProgressListener $pl): array {
        $pl->updateMessage("Serializing Creators");
        $count = 0;
        $offset = 0;
        $limit = 10;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        if (!is_dir($storage)) mkdir($storage);
        array_map('unlink', array_filter((array)glob($storage . DIRECTORY_SEPARATOR . "*")));
        do {
            $creators = $this->selectWhere("1 = 1", $offset, $limit);
            foreach ($creators as $creator) {
                $file = $storage . DIRECTORY_SEPARATOR . "creator_"
                    . sprintf("%05d", $creator->getID()) . ".json";
                file_put_contents($file, $creator->serialize());
                $count++;
                $pl->increase();
            }
            $offset += $limit;
        } while (!empty($creators));
        Log::info("Serialized " . $count . " Creators");
        return [self::SERIALIZATION_DIRECTORY => $count];
    }


    /**
     * Deserialize from serialization files and store Creators
     * @param string $datastore directory where to find serialization files
     * @param ProgressListener $pl
     * @return array<string, int> count of deserialized creators
     * @throws Exception
     */
    public function deserialize(string $datastore, ProgressListener $pl): array {
        $pl->updateMessage("Deserializing Creators");
        $count = 0;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        $filenames = array_diff(scandir($storage), array("..", ".", ".DS_Store"));
        foreach ($filenames as $filename) {
            $creator = Creator::deserialize(
                file_get_contents($storage . DIRECTORY_SEPARATOR . $filename));
            Dao::creatorDao()->insert($creator->getCreatorDo(), true);
            $count++;
            $pl->increase();
        }
        Log::info("Deserialized " . $count . " Creators");
        return [self::SERIALIZATION_DIRECTORY => $count];
    }

}