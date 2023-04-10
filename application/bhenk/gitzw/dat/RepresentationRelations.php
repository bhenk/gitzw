<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ResJoinRepDo;
use Exception;
use function array_keys;
use function in_array;
use function is_null;

class RepresentationRelations {

    /** @var ResJoinRepDo[]|null */
    private ?array $relations = null;

    /** @var Resource[]|null */
    private ?array $resources = null;

    function __construct(private readonly ?int $representationId) {
    }

    /**
     * @param int $resourceId
     * @return ResJoinRepDo|null
     * @throws Exception
     */
    public function getRelation(int $resourceId): ?ResJoinRepDo {
        $this->getRelations();
        if (in_array($resourceId, array_keys($this->relations))) return $this->relations[$resourceId];
        return null;
    }

    /**
     * @return array|ResJoinRepDo[]
     * @throws Exception
     */
    public function getRelations(): array {
        if (is_null($this->relations)) {
            if (is_null($this->representationId)) {
                $this->relations = [];
            } else {
                $this->relations = Dao::resJoinRepDao()->selectRight($this->representationId);
            }
        }
        return $this->relations;
    }

    /**
     * @param int $resourceId
     * @return Resource|null
     * @throws Exception
     */
    public function getResource(int $resourceId): ?Resource {
        $this->getResources();
        if (in_array($resourceId, array_keys($this->resources))) return $this->resources[$resourceId];
        return null;
    }

    /**
     * @return Resource[]
     * @throws Exception
     */
    public function getResources(): array {
        if (is_null($this->resources)) {
            $relations = $this->getRelations();
            if (!empty($relations)) {
                $this->resources = Store::resourceStore()->selectBatch(array_keys($relations));
            }
        }
        return $this->resources;
    }

}