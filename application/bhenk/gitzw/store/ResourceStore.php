<?php

namespace bhenk\gitzw\store;

use bhenk\doc2rst\log\Log;
use bhenk\gitzw\dao\RepresentationDao;
use bhenk\gitzw\dao\ResourceDao;
use bhenk\gitzw\dao\ResourceDo;
use bhenk\gitzw\dao\ResRepDao;
use bhenk\gitzw\dao\ResRepDo;
use bhenk\gitzw\dat\Resource;
use Exception;
use function count;
use function is_null;

class ResourceStore {

    private ?ResourceDao $resourceDao = null;
    private ?ResRepDao $resRepDao = null;
    private ?RepresentationDao $representationDao = null;

    /**
     * @param Resource $resource
     * @return Resource
     * @throws Exception
     */
    public function storeResource(Resource $resource): Resource {
        if (is_null($resource->getID())) {
            return $this->insertResource($resource);
        } else {
            return $this->updateResource($resource);
        }
    }

    /**
     * @param int $ID
     * @return bool|Resource
     * @throws Exception
     */
    public function getResourceById(int $ID): bool|Resource {
        /** @var ResourceDo $resourceDo */
        $resourceDo = $this->getResourceDao()->select($ID);
        if ($resourceDo) {
            return $this->assembleResource($resourceDo);
        }
        return false;
    }

    /**
     * @param string $RESID
     * @return bool|Resource
     * @throws Exception
     */
    public function getResourceByRESID(string $RESID): bool|Resource {
        $arr = $this->getResourceDao()->selectWhere("RESID='" . $RESID . "'");
        if (count($arr) == 1) {
            return $this->assembleResource($arr[0]);
        }
        if (count($arr) > 1) Log::warning("RESID not unique: " . $RESID);
        return false;
    }

    /**
     * @param Resource $resource
     * @return Resource
     * @throws Exception
     */
    private function insertResource(Resource $resource): Resource {
        /** @var ResourceDo $resourceDo */
        $resourceDo = $this->getResourceDao()->insert($resource->getResourceDo());
        $representations = $resource->getRepresentations();
        $repRelations = $this->updateRepRelations($resourceDo->getID(), $resource->getRepRelations());
        return new Resource($resourceDo, $representations, $repRelations);
    }

    /**
     * @param Resource $resource
     * @return Resource
     * @throws Exception
     */
    private function updateResource(Resource $resource): Resource {
        $this->getResourceDao()->update($resource->getResourceDo());
        $representations = $resource->getRepresentations();
        $repRelations = $this->updateRepRelations($resource->getID(), $resource->getRepRelations());
        return new Resource($resource->getResourceDo(), $representations, $repRelations);
    }

    /**
     * @param int $resourceId
     * @param ResRepDo[] $repRelations
     * @return ResRepDo[] array with RepresentationID as key
     * @throws Exception
     */
    private function updateRepRelations(int $resourceId, array $repRelations): array {
        $ingests = [];
        $deletes = [];
        $updates = [];
        foreach ($repRelations as $resRepDo) {
            $resRepDo->setResourceID($resourceId);
            if (is_null($resRepDo->getID()) and !$resRepDo->isDeleted()) {
                $ingests[] = $resRepDo;
            } elseif ($resRepDo->isDeleted()) {
                $deletes[] = $resRepDo->getID();
            } else {
                $updates[$resRepDo->getRepresentationID()] = $resRepDo;
            }
        }
        if (!empty($deletes)) {
            $this->getResRepDao()->deleteBatch($deletes);
        }
        if (!empty($updates)) {
            $this->getResRepDao()->updateBatch($updates);
        }
        if (!empty($ingests)) {
            $inserted = $this->getResRepDao()->insertBatch($ingests);
            /** @var ResRepDo $insert */
            foreach ($inserted as $insert) {
                $updates[$insert->getRepresentationID()] = $insert;
            }
        }
        return $updates;
    }

    /**
     * @param ResourceDo $resourceDo
     * @return Resource
     * @throws Exception
     */
    private function assembleResource(ResourceDo $resourceDo): Resource {
        $resRepDos = $this->getResRepDao()->selectWhere("resourceID=" . $resourceDo->getID());
        if (empty($resRepDos)) {
            return new Resource($resourceDo);
        }
        $representationIds = [];
        $repRelations = [];
        /** @var ResRepDo $resRepDo */
        foreach ($resRepDos as $resRepDo) {
            $representationIds[] = $resRepDo->getRepresentationID();
            $repRelations[$resRepDo->getRepresentationID()] = $resRepDo;
        }
        $reps = $this->getRepresentationDao()->selectBatch($representationIds);
        $representations = [];
        foreach ($reps as $rep) {
            $representations[$rep->getID()] = $rep;
        }
        return new Resource($resourceDo, $representations, $repRelations);
    }

    private function getResourceDao(): ResourceDao {
        if (is_null($this->resourceDao)) {
            $this->resourceDao = new ResourceDao();
        }
        return $this->resourceDao;
    }

    private function getResRepDao(): ResRepDao {
        if (is_null($this->resRepDao)) {
            $this->resRepDao = new ResRepDao();
        }
        return $this->resRepDao;
    }

    private function getRepresentationDao(): RepresentationDao {
        if (is_null($this->representationDao)) {
            $this->representationDao = new RepresentationDao();
        }
        return $this->representationDao;
    }



}