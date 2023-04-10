<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ResJoinRepDo;
use Exception;
use function array_keys;
use function in_array;
use function is_null;

/**
 * The ResourceRelations object keeps track of relations the owner {@link Resource} has to
 * other objects.
 */
class ResourceRelations {

    /** @var ResJoinRepDo[]|null */
    private ?array $relations = null;

    /** @var Representation[]|null */
    private ?array $representations = null;

    /**
     * Construct a ResourceRelations object
     *
     * @param int|null $resourceId ID of the owner object or *null* if it does not have an ID (yet)
     */
    function __construct(private readonly ?int $resourceId = null) {
    }

    /**
     * Add a {@link Representation}
     *
     * The {@link $representation} can be the Representation ID (int), the Representation REPID (string)
     * or the Representation (Object) itself. Only Representations that are persisted can be added.
     *
     *
     * @param int|string|Representation $representation Representation ID (int), Representation REPID (string)
     *    or Representation (object)
     * @return bool|ResJoinRepDo relation data object if representation successfully added, *false* otherwise
     * @throws Exception
     */
    public function addRepresentation(int|string|Representation $representation): bool|ResJoinRepDo {
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
        return $relation;
    }

    /**
     * Lazily fetch the related Representations
     *
     * @return Representation[] array with Representation ID as key
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
     * Lazily fetch the join objects aka relations
     *
     * @return ResJoinRepDo[] array with Representation ID as key
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
     * Remove a {@link Representation}
     *
     * The {@link $representation} can be the Representation ID (int), the Representation REPID (string)
     * or the Representation (Object) itself. Only Representations that are persisted and are
     * related can be removed.
     *
     * @param int|string|Representation $representation Representation ID (int), Representation REPID (string)
     *    or Representation (object)
     * @return bool *true* if representation successfully removed, *false* otherwise
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

    /**
     * Persist relations kept by this Relations Object
     *
     * This action ingests, updates and deletes relations. After a call to this method all relations
     * kept by this ResourceRelations object are in sync with the persistence store.
     *
     * @param int $resourceId ID of the owner object
     * @return bool *true* if relations were present, *false* otherwise
     * @throws Exception
     */
    public function persist(int $resourceId): bool {
        if (!is_null($this->relations) and !empty($this->relations)) {
            $this->relations = Dao::resJoinRepDao()->updateLeftJoin($resourceId, $this->relations);
            return true;
        }
        return false;
    }

    /**
     * Get the relation data object that relates the Representation with the given ID
     *
     * @param int $representationId ID of the Representation
     * @return ResJoinRepDo|null relation data object or *null* if relation not present
     * @throws Exception
     */
    public function getRelation(int $representationId): ?ResJoinRepDo {
        $this->getRelations();
        if (in_array($representationId, array_keys($this->relations))) return $this->relations[$representationId];
        return null;
    }

    /**
     * Get the Representation with the given Representation ID
     *
     * @param int $representationId ID of the Representation
     * @return Representation|null Representation or *null* if no such representation
     * @throws Exception
     */
    public function getRepresentation(int $representationId): ?Representation {
        $this->getRepresentations();
        if (in_array($representationId, array_keys($this->representations)))
            return $this->representations[$representationId];
        return null;
    }
}