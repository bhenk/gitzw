<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\WorkHasRepDo;
use Exception;
use function array_diff_key;
use function array_fill_keys;
use function array_keys;
use function array_values;
use function count;
use function in_array;
use function is_null;
use function uasort;

/**
 * The WorkRelations object keeps track of relations the owner {@link Work} has to
 * other objects.
 */
class WorkRelations extends RepresentationOwner {

    /** @var WorkHasRepDo[]|null */
    private ?array $repRelations;
    private ?array $workRepresentations = null;

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
     * Get assemble of WorkHasRepDo and Representation in an ordered array
     *
     * The array is ordered using WorkHasRepDo->ordinal, keys in the array are Representation IDs.
     * @return WorkRepresentation[]
     * @throws Exception
     */
    public function getWorkRepresentations(): array {
        if (is_null($this->workRepresentations)) {
            $this->workRepresentations = [];
            $representations = $this->getRepresentations();
            foreach ($this->getRepRelations() as $workHasRepDo) {
                $representation = $representations[$workHasRepDo->getFkRight()];
                $workRepresentation = new WorkRepresentation($workHasRepDo, $representation);
                $this->workRepresentations[$representation->getID()] = $workRepresentation;
            }
            uasort($this->workRepresentations, function ($a, $b) {
                $ao = $a->getOrdinal();
                $bo = $b->getOrdinal();
                if ($ao == $bo) return 0;
                return $ao > $bo ? 1: -1;
            });
        }
        return $this->workRepresentations;
    }

    /**
     * Get the preferred Representation
     *
     * @return WorkRepresentation|null preferred, first or null
     * @throws Exception
     */
    public function getPreferredRepresentation(): ?Representation {
        foreach ($this->getWorkRepresentations() as $workRepresentation) {
            if ($workRepresentation->isPreferred()) {
                return $workRepresentation->getRepresentation();
            }
        }
        return array_values($this->getRepresentations())[0] ?? null;
    }

    public function getOtherWorkRepresentations(array $excludedIDs = []): array {
        return array_diff_key($this->getWorkRepresentations(), array_fill_keys($excludedIDs, 0));
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