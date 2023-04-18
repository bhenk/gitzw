<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\WorkDo;
use bhenk\logger\log\Log;
use Exception;
use function array_values;
use function count;
use function gettype;
use function is_null;

/**
 * Store for obtaining and persisting Resources
 */
class WorkStore {

    const SERIALIZATION_DIRECTORY = "works";

    /**
     * Persist the given Work
     *
     * The {@link Work} is inserted or updated. {@link WorkRelations} of the Work are
     * inserted, updated or deleted.
     *
     * @param Work $resource the Resource to persist
     * @return Work the Resource after persistence (includes Primary ID)
     * @throws Exception
     */
    public function persist(Work $resource): Work {
        if (is_null($resource->getID())) {
            return $this->ingest($resource);
        } else {
            return $this->update($resource);
        }
    }

    /**
     * @param Work $resource
     * @return Work
     * @throws Exception
     */
    private function ingest(Work $resource): Work {
        /** @var WorkDo $do */
        $do = Dao::workDao()->insert($resource->getResourceDo());
        $relations = $resource->getRelations();
        $relations->persist($do->getID());
        return new Work($do);
    }

    /**
     * @param Work $resource
     * @return Work
     * @throws Exception
     */
    private function update(Work $resource): Work {
        Dao::workDao()->update($resource->getResourceDo());
        $relations = $resource->getRelations();
        $relations->persist($resource->getID());
        return new Work($resource->getResourceDo());
    }

    /**
     * @param Work[] $resources
     * @return Work[]
     * @throws Exception
     */
    public function persistBatch(array $resources): array {
        $results = [];
        foreach ($resources as $resource) {
            if (is_null($resource->getID())) {
                $newResource = $this->ingest($resource);
                $results[$newResource->getID()] = $newResource;
            } else {
                $newResource = $this->update($resource);
                $results[$newResource->getID()] = $newResource;
            }
        }
        return $results;
    }

    /**
     * @param int|string|Work $resource
     * @return bool|Work
     * @throws Exception
     */
    public function get(int|string|Work $resource): bool|Work {
        if ($resource instanceof Work) return $resource;
        if (gettype($resource) == "integer") return $this->select($resource);
        if (gettype($resource) == "string") return $this->selectByRESID($resource);
        return false;
    }

    /**
     * Select Resource with given ID
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
     * Select Resource with given alternative RESID
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
     * Select Resources with a where-clause
     * @param string $where expression
     * @param int $offset start index
     * @param int $limit max number of Resources to return
     * @return array<int, Work> array of Resources or empty array if end of storage reached
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
     * Select Resources with given IDs
     *
     * @param int[] $IDs Resource IDs
     * @return Work[] array of stored Resources
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
     * Delete a Resource
     * @param int $ID ID of Resource
     * @return int rows affected
     * @throws Exception
     */
    public function delete(int $ID): int {
        return Dao::workDao()->delete($ID);
    }

    /**
     * Delete Resources
     * @param array $IDs IDs of Resources to delete
     * @return int count of deleted Resources
     * @throws Exception
     */
    public function deleteBatch(array $IDs): int {
        return Dao::workDao()->deleteBatch($IDs);
    }

    /**
     * Delete Resources with a where-clause
     * @param string $where expression
     * @return int count of deleted Resources
     * @throws Exception
     */
    public function deleteWhere(string $where): int {
        return Dao::workDao()->deleteWhere($where);
    }

    /**
     * Serialize all the Resources
     * @param string $datastore directory for serialization files
     * @return array [count of serialized resources, count of serialized relations]
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
                $file = $storage . DIRECTORY_SEPARATOR . "resource_"
                    . sprintf("%05d", $resource->getID()) . ".json";
                file_put_contents($file, $resource->serialize());
                $count++;
                $countRelations += count($resource->getRelations()->getRepresentationRelations());
            }
            $offset += $limit;
        } while (!empty($resources));
        Log::info("Serialized " . $count . " Resources");
        return [$count, $countRelations];
    }

    /**
     * Deserialize from serialization files and store Resources and ResourceRelations
     * @param string $datastore directory where to find serialization files
     * @return array array[count of deserialized resources, count of deserialized relations]
     * @throws Exception
     */
    public function deserialize(string $datastore): array {
        $count = 0;
        $relationCount = 0;
        $storage = $datastore . DIRECTORY_SEPARATOR . self::SERIALIZATION_DIRECTORY;
        $filenames = array_diff(scandir($storage), array("..", ".", ".DS_Store"));
        // create new table with different name: 'tbl_resources_tmp'
        Dao::workDao()->setTemp(true);
        Dao::workDao()->createTable(true);
        Dao::workHasRepDao()->setTemp(true);
        Dao::workHasRepDao()->createTable(true);
        foreach ($filenames as $filename) {
            $resource = Work::deserialize(
                file_get_contents($storage . DIRECTORY_SEPARATOR . $filename));
            Dao::workDao()->insert($resource->getResourceDo(), true);
            $relationCount += $resource->getRelations()->deserialize();
            $count++;
        }
        Dao::workDao()->setTemp(false);
        Dao::workHasRepDao()->setTemp(false);
        return [$count, $relationCount];
    }

}