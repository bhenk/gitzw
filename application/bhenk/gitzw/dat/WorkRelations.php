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
class WorkRelations extends RepresentationOwner {

    /** @var WorkHasRepDo[]|null */
    private ?array $repRelations;

    /**
     * Construct a WorkRelations object
     *
     * @param int|null $workID ID of the owner object or *null* if it does not have an ID (yet)
     * @param WorkHasRepDo[]|null $repRelations
     */
    function __construct(private readonly ?int $workID = null,
                         ?array                $repRelations = null) {
        $this->repRelations = $repRelations;
    }

    public function getOwnerID(): ?string {
        return $this->workID;
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
        $this->resetMessages();
        $representation = $this->workCanAddRepresentation($representation);
        if (!$representation) return false;
        ////
        $this->doAddRepr($representation);
        $this->getRepRelations();
        $workHasRep = new WorkHasRepDo(null, $this->workID, $representation->getID());
        $this->repRelations[$representation->getID()] = $workHasRep;
        return $workHasRep;
    }

    public function removeRepresentation(Representation|int|string $representation): bool {
        $this->resetMessages();
        $representation = $this->workCanRemoveRepresentation($representation);
        if (!$representation) return false;
        return parent::removeRepresentation($representation);
    }

    /**
     * Lazily fetch the join objects aka repRelations
     *
     * @return WorkHasRepDo[] array with Representation ID as key
     * @throws Exception
     */
    public function getRepRelations(): array {
        if (is_null($this->repRelations)) {
            if (is_null($this->workID)) {
                $this->repRelations = [];
            } else {
                $this->repRelations = Dao::workHasRepDao()->selectLeft($this->workID);
            }
        }
        return $this->repRelations;
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
     * @internal
     */
    public function persist(int $workId): bool {
        if (!is_null($this->repRelations) and !empty($this->repRelations)) {
            $this->repRelations =
                Dao::workHasRepDao()->updateLeftJoin($workId, $this->repRelations);
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
        $this->getRepRelations();
        if (in_array($representationId, array_keys($this->repRelations)))
            return $this->repRelations[$representationId];
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
        if (!is_null($this->repRelations) and !empty($this->repRelations)) {
            $inserted = Dao::workHasRepDao()->insertBatch($this->repRelations, null, true);
            $relationCount = count($inserted);
        }
        return $relationCount;
    }
}