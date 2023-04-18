<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\WorkHasRepDo;
use Exception;
use function array_keys;
use function in_array;
use function is_null;

class RepresentationRelations {

    /** @var WorkHasRepDo[]|null */
    private ?array $relations = null;

    /** @var Work[]|null */
    private ?array $resources = null;

    function __construct(private readonly ?int $representationId) {
    }

    /**
     * @param int $resourceId
     * @return WorkHasRepDo|null
     * @throws Exception
     */
    public function getRelation(int $resourceId): ?WorkHasRepDo {
        $this->getRelations();
        if (in_array($resourceId, array_keys($this->relations))) return $this->relations[$resourceId];
        return null;
    }

    /**
     * @return array|WorkHasRepDo[]
     * @throws Exception
     */
    public function getRelations(): array {
        if (is_null($this->relations)) {
            if (is_null($this->representationId)) {
                $this->relations = [];
            } else {
                $this->relations = Dao::workHasRepDao()->selectRight($this->representationId);
            }
        }
        return $this->relations;
    }

    /**
     * @param int $resourceId
     * @return Work|null
     * @throws Exception
     */
    public function getResource(int $resourceId): ?Work {
        $this->getResources();
        if (in_array($resourceId, array_keys($this->resources))) return $this->resources[$resourceId];
        return null;
    }

    /**
     * @return Work[]
     * @throws Exception
     */
    public function getResources(): array {
        if (is_null($this->resources)) {
            $relations = $this->getRelations();
            if (!empty($relations)) {
                $this->resources = Store::workStore()->selectBatch(array_keys($relations));
            }
        }
        return $this->resources;
    }

}