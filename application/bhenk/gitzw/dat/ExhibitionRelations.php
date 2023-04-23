<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ExhHasRepDo;
use Exception;
use function array_keys;
use function count;
use function in_array;
use function is_null;

/**
 * The ExhibitionRelations object keeps track of the relations the owner Exhibition has to other objects
 */
class ExhibitionRelations extends RepresentationOwner {

    /** @var array<int, ExhHasRepDo>|null */
    private ?array $repRelations;

    /**
     * Construct a ExhibitionRelations object
     *
     * @param int|null $exhibitionID ID of the owner Exhibition
     * @param array<int, ExhHasRepDo>|null $repRelations
     */
    function __construct(private readonly ?int $exhibitionID = null,
                         ?array                $repRelations = null) {
        $this->repRelations = $repRelations;
    }

    /**
     * Get the ID of the Exhibition that owns these relations
     * @return string|null
     */
    public function getOwnerId(): ?string {
        return $this->exhibitionID;
    }

    /**
     * Add a Representation to this Exhibition
     *
     * Only Representations that are persisted and that are related to at least one Work can be added.
     *
     * @param int|string|Representation $representation Representation ID (int), Representation REPID (string)
     *     or Representation (object)
     * @return bool|ExhHasRepDo relation Data Object if successful, *false* otherwise
     * @throws Exception
     * @see ExhibitionRelations::getLastMessage()
     */
    public function addRepresentation(int|string|Representation $representation): bool|ExhHasRepDo {
        $this->resetMessages();
        $representation = $this->exhibitionCanAddRepresentation($representation);
        if (!$representation) return false;
        ////
        $this->doAddRepr($representation);
        $this->getRepRelations();
        $exhHasRep = new ExhHasRepDo(null, $this->exhibitionID, $representation->getID());
        $this->repRelations[$representation->getID()] = $exhHasRep;
        return $exhHasRep;
    }

    /**
     * @param Representation|int|string $representation
     * @return bool
     * @throws Exception
     */
    public function removeRepresentation(Representation|int|string $representation): bool {
        $this->resetMessages();
        $representation = $this->exhibitionCanRemoveRepresentation($representation);
        if (!$representation) return false;
        return parent::removeRepresentation($representation);
    }

    /**
     * Lazily fetch the join objects aka ExhHasRepDo's
     * @return array|ExhHasRepDo[] array with Representation ID as key
     * @throws Exception
     */
    public function getRepRelations(): array {
        if (is_null($this->repRelations)) {
            if (is_null($this->exhibitionID)) {
                $this->repRelations = [];
            } else {
                $this->repRelations = Dao::exhHasRepDao()->selectLeft($this->exhibitionID);
            }
        }
        return $this->repRelations;
    }

    /**
     * Persist relations kept by this Relations Object
     * @param int $exhibitionID ID of the owner object
     * @return bool *true* if relations were present, *false* otherwise
     * @throws Exception
     * @internal
     */
    public function persist(int $exhibitionID): bool {
        if (!is_null($this->repRelations) and !empty($this->repRelations)) {
            Dao::exhHasRepDao()->updateLeftJoin($exhibitionID, $this->repRelations);
            return true;
        }
        return false;
    }

    /**
     * Get the relation data object that relates the Work with the given ID
     * @param int $workID ID of the work
     * @return ExhHasRepDo|null relation data object or *null* if relation not present
     * @throws Exception
     */
    public function getRelation(int $workID): ?ExhHasRepDo {
        $this->getRepRelations();
        if (in_array($workID, array_keys($this->repRelations))) return $this->repRelations[$workID];
        return null;
    }

    /**
     * Function called by ExhibitionStore
     * @return int count of persisted relations
     * @throws Exception
     * @internal
     */
    public function deserialize(): int {
        $relationCount = 0;
        if (!is_null($this->repRelations) and !empty($this->repRelations)) {
            $inserted = Dao::exhHasRepDao()->insertBatch($this->repRelations);
            $relationCount = count($inserted);
        }
        return $relationCount;
    }

}