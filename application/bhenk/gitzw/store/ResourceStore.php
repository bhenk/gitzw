<?php

namespace bhenk\gitzw\store;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ResourceDo;
use bhenk\gitzw\dat\Resource;
use Exception;
use function array_values;
use function count;
use function is_null;

class ResourceStore {

    /**
     * @param Resource $resource
     * @return Resource
     * @throws Exception
     */
    public function persist(Resource $resource): Resource {
        if (is_null($resource->getID())) {
            return $this->ingest($resource);
        } else {
            return $this->updateResource($resource);
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
    private function updateResource(Resource $resource): Resource {
        Dao::resourceDao()->update($resource->getResourceDo());
        $relations = $resource->getRelations();
        $relations->persist($resource->getID());
        return new Resource($resource->getResourceDo());
    }

    /**
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
     * @param string $RESID
     * @return bool|Resource
     * @throws Exception
     */
    public function selectByRESID(string $RESID): bool|Resource {
        $arr = Dao::resourceDao()->selectWhere("RESID='" . $RESID . "'");
        if (count($arr) == 1) return new Resource(array_values($arr)[0]);
        return false;
    }

}