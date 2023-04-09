<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ResJoinRepDo;
use bhenk\gitzw\store\Store;
use Exception;
use function array_keys;
use function in_array;
use function is_null;

class ResourceRelations {

    /** @var ResJoinRepDo[]|null */
    private ?array $relations = null;

    /** @var Representation[]|null */
    private ?array $representations = null;

    function __construct(private readonly ?int $resourceId = null) {
    }

    /**
     * @param int|string|Representation $representation
     * @return bool
     * @throws Exception
     */
    public function addRepresentation(int|string|Representation $representation): bool {
        $representation = Store::representationStore()->get($representation);
        if (!$representation) return false;
        $representationId = $representation->getID();
        if (is_null($representationId)) return false;
        $this->getRepresentations();
        if (in_array($representationId, array_keys($this->representations))) return false;
        ////
        $this->representations[$representationId] = $representation;
        $this->getRelations();
        $relation = new ResJoinRepDo(null, $this->resourceId, $representationId);
        $this->relations[$representationId] = $relation;
        return true;
    }

    /**
     * @return Representation[]
     * @throws Exception
     */
    public function getRepresentations(): array {
        if (is_null($this->representations)) {
            $this->representations = [];
            $relations = $this->getRelations();
            if (!empty($relations)) {
                $this->representations = Store::representationStore()->selectBatch(array_keys($relations));
            }
        }
        return $this->representations;
    }

    /**
     * @return ResJoinRepDo[]
     * @throws Exception
     */
    public function getRelations(): array {
        if (is_null($this->relations)) {
            if (is_null($this->resourceId)) {
                $this->relations = [];
            } else {
                $this->relations = Dao::resJoinRepDao()->selectLeft($this->resourceId);
            }
        }
        return $this->relations;
    }

    /**
     * @param int|string|Representation $representation
     * @return bool
     * @throws Exception
     */
    public function removeRepresentation(int|string|Representation $representation): bool {
        $representation = Store::representationStore()->get($representation);
        if (!$representation) return false;
        $representationId = $representation->getID();
        if (is_null($representationId)) return false;
        $this->getRepresentations();
        if (!in_array($representationId, array_keys($this->representations))) return false;
        ////
        unset($this->representations[$representationId]);
        $this->getRelations();
        if (in_array($representationId, array_keys($this->relations))) {
            $this->relations[$representationId]->setDeleted(true);
        }
        return true;
    }

    public function persist(int $resourceId): bool {
        if (!is_null($this->relations) and !empty($this->relations)) {
            Dao::resJoinRepDao()->persist($resourceId, $this->relations);
            return true;
        }
        return false;
    }

}