<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ResourceDo;
use Exception;
use function array_values;
use function count;
use function is_null;

/**
 * Store for obtaining and persisting Resources
 */
class ResourceStore {

    /**
     * Persist the given Resource
     *
     * The {@link Resource} is inserted or updated. {@link ResourceRelations} of the Resource are
     * inserted, updated or deleted.
     *
     * @param Resource $resource the Resource to persist
     * @return Resource the Resource after persistence (includes Primary ID)
     * @throws Exception
     */
    public function persist(Resource $resource): Resource {
        if (is_null($resource->getID())) {
            return $this->ingest($resource);
        } else {
            return $this->update($resource);
        }
    }

    /**
     * @param Resource $resource
     * @return Resource
     * @throws Exception
     */
    private function ingest(Resource $resource): Resource {
        /** @var ResourceDo $do */
        $do = Dao::resourceDao()->insert($resource->getResourceDo());
        $relations = $resource->getRelations();
        $relations->persist($do->getID());
        return new Resource($do);
    }

    /**
     * @param Resource $resource
     * @return Resource
     * @throws Exception
     */
    private function update(Resource $resource): Resource {
        Dao::resourceDao()->update($resource->getResourceDo());
        $relations = $resource->getRelations();
        $relations->persist($resource->getID());
        return new Resource($resource->getResourceDo());
    }

    /**
     * Select Resource with given ID
     * @param int $ID
     * @return bool|Resource
     * @throws Exception
     */
    public function select(int $ID): bool|Resource {
        /** @var ResourceDo $do */
        $do = Dao::resourceDao()->select($ID);
        if ($do) return new Resource($do);
        return false;
    }

    /**
     * Select Resource with given alternative RESID
     * @param string $RESID
     * @return bool|Resource
     * @throws Exception
     */
    public function selectByRESID(string $RESID): bool|Resource {
        $arr = Dao::resourceDao()->selectWhere("RESID='" . $RESID . "'");
        if (count($arr) == 1) return new Resource(array_values($arr)[0]);
        return false;
    }

    /**
     * Select Resources with given IDs
     *
     * @param int[] $IDs Resource IDs
     * @return Resource[] array of stored Resources
     * @throws Exception
     */
    public function selectBatch(array $IDs): array {
        $resources = [];
        $dos = Dao::resourceDao()->selectBatch($IDs);
        /** @var ResourceDo $do */
        foreach ($dos as $do) {
            $resources[$do->getID()] = new Resource($do);
        }
        return $resources;
    }

}