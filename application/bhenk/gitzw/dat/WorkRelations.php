<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\WorkHasRepDo;
use Exception;
use function array_keys;
use function count;
use function in_array;
use function is_null;

/**
 * The WorkRelations object keeps track of relations the owner {@link Work} has to
 * other objects.
 */
class WorkRelations {

    /** @var WorkHasRepDo[]|null */
    private ?array $representationRelations = null;

    /** @var Representation[]|null */
    private ?array $representations = null;

    /**
     * Construct a WorkRelations object
     *
     * @param int|null $workId ID of the owner object or *null* if it does not have an ID (yet)
     */
    function __construct(private readonly ?int $workId = null,
                         ?array                $representationRelations = null) {
        $this->representationRelations = $representationRelations;
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
     * @return bool|WorkHasRepDo relation data object if representation successfully added, *false* otherwise
     * @throws Exception
     */
    public function addRepresentation(int|string|Representation $representation): bool|WorkHasRepDo {
        $representation = Store::representationStore()->get($representation);
        if (!$representation) return false;
        $representationId = $representation->getID();
        if (is_null($representationId)) return false;
        $this->getRepresentations();
        if (in_array($representationId, array_keys($this->representations))) return false;
        ////
        $this->representations[$representationId] = $representation;
        $this->getRepresentationRelations();
        $resRep = new WorkHasRepDo(null, $this->workId, $representationId);
        $this->representationRelations[$representationId] = $resRep;
        return $resRep;
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
            $representationRelations = $this->getRepresentationRelations();
            if (!empty($representationRelations)) {
                $this->representations =
                    Store::representationStore()->selectBatch(array_keys($representationRelations));
            }
        }
        return $this->representations;
    }

    /**
     * Lazily fetch the join objects aka representationRelations
     *
     * @return WorkHasRepDo[] array with Representation ID as key
     * @throws Exception
     */
    public function getRepresentationRelations(): array {
        if (is_null($this->representationRelations)) {
            if (is_null($this->workId)) {
                $this->representationRelations = [];
            } else {
                $this->representationRelations = Dao::workHasRepDao()->selectLeft($this->workId);
            }
        }
        return $this->representationRelations;
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
        $this->getRepresentationRelations();
        if (in_array($representationId, array_keys($this->representationRelations))) {
            $this->representationRelations[$representationId]->setDeleted(true);
        }
        return true;
    }

    /**
     * Persist relations kept by this Relations Object
     *
     * This action ingests, updates and deletes relations. After a call to this method all relations
     * kept by this WorkRelations object are in sync with the persistence store.
     *
     * @param int $workId ID of the owner object
     * @return bool *true* if relations were present, *false* otherwise
     * @throws Exception
     */
    public function persist(int $workId): bool {
        if (!is_null($this->representationRelations) and !empty($this->representationRelations)) {
            $this->representationRelations =
                Dao::workHasRepDao()->updateLeftJoin($workId, $this->representationRelations);
            return true;
        }
        return false;
    }

    /**
     * Get the relation data object that relates the Representation with the given ID
     *
     * @param int $representationId ID of the Representation
     * @return WorkHasRepDo|null relation data object or *null* if relation not present
     * @throws Exception
     */
    public function getRelation(int $representationId): ?WorkHasRepDo {
        $this->getRepresentationRelations();
        if (in_array($representationId, array_keys($this->representationRelations))) return $this->representationRelations[$representationId];
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

    /**
     * Function called by WorkStore
     * @return int count of persisted relations
     * @throws Exception
     * @internal Not public API
     */
    public function deserialize(): int {
        $relationCount = 0;
        if (!is_null($this->representationRelations) and !empty($this->representationRelations)) {
            $inserted = Dao::workHasRepDao()->insertBatch($this->representationRelations, null, true);
            $relationCount = count($inserted);
        }
        return $relationCount;
    }
}