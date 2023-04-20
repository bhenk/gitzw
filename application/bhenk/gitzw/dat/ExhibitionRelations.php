<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ExhHasWorkDo;
use Exception;
use function array_keys;
use function count;
use function in_array;
use function is_null;

/**
 * The ExhibitionRelations object keeps track of the relations the owner Exhibition has to other objects
 */
class ExhibitionRelations {

    /** @var array<int, ExhHasWorkDo>|null */
    private ?array $workRelations;
    /** @var array<int, Work>|null */
    private ?array $works;

    /**
     * Construct a ExhibitionRelations object
     *
     * @param int|null $exhibitionID ID of the owner Exhibition
     * @param array<int, Work>|null $workRelations
     */
    function __construct(private readonly ?int $exhibitionID = null,
                         ?array                $workRelations = null) {
        $this->workRelations = $workRelations;
    }

    /**
     * Add a work to this Exhibition
     *
     * Only Works that are persisted can be added.
     *
     * @param int|string|Work $work Work ID (int), Work RESID (string) or Work (object)
     * @return bool|ExhHasWorkDo relation Data Object if successful, *false* otherwise
     * @throws Exception
     */
    public function addWork(int|string|Work $work): bool|ExhHasWorkDo {
        $work = Store::workStore()->get($work);
        if (!$work) return false;
        $workID = $work->getID();
        if (is_null($workID)) return false;
        $this->getWorks();
        if (in_array($workID, array_keys($this->works))) return false;
        ////
        $this->works[$workID] = $work;
        $this->getWorkRelations();
        $exhHasWork = new ExhHasWorkDo(null, $this->exhibitionID, $workID);
        $this->workRelations[$workID] = $exhHasWork;
        return $exhHasWork;
    }

    /**
     * Lazily fetch the related works
     * @return array|Work[]|null
     * @throws Exception
     */
    public function getWorks(): ?array {
        if (is_null($this->works)) {
            $this->works = [];
            $workRelations = $this->getWorkRelations();
            if (!empty($workRelations)) {
                $this->works = Store::workStore()->selectBatch(array_keys($workRelations));
            }
        }
        return $this->works;
    }

    /**
     * Lazily fetch the join objects aka ExhHasWorkDo's
     * @return array|ExhHasWorkDo[]|null array with workId as key
     * @throws Exception
     */
    public function getWorkRelations(): ?array {
        if (is_null($this->workRelations)) {
            if (is_null($this->exhibitionID)) {
                $this->workRelations = [];
            } else {
                $this->workRelations = Dao::exhHasWorkDao()->selectLeft($this->exhibitionID);
            }
        }
        return $this->workRelations;
    }

    /**
     * Remove a Work from this Exhibition
     * @param int|string|Work $work Work ID (int), Work RESID (string) or Work (object)
     * @return bool *true* if Work successfully removed, *false* otherwise
     * @throws Exception
     */
    public function removeWork(int|string|Work $work): bool {
        $work = Store::workStore()->get($work);
        if (!$work) return false;
        $workID = $work->getID();
        if (is_null($workID)) return false;
        $this->getWorks();
        if (in_array($workID, array_keys($this->works))) return false;
        ////
        unset($this->works[$workID]);
        $this->getWorkRelations();
        if (in_array($workID, array_keys($this->workRelations))) {
            $this->workRelations[$workID]->setDeleted(true);
        }
        return true;
    }

    /**
     * Persist relations kept by this Relations Object
     * @param int $exhibitionID ID of the owner object
     * @return bool *true* if relations were present, *false* otherwise
     * @throws Exception
     * @internal
     */
    public function persist(int $exhibitionID): bool {
        if (!is_null($this->workRelations) and !empty($this->workRelations)) {
            Dao::exhHasWorkDao()->updateLeftJoin($exhibitionID, $this->workRelations);
            return true;
        }
        return false;
    }

    /**
     * Get the relation data object that relates the Work with the given ID
     * @param int $workID ID of the work
     * @return ExhHasWorkDo|null relation data object or *null* if relation not present
     * @throws Exception
     */
    public function getRelation(int $workID): ?ExhHasWorkDo {
        $this->getWorkRelations();
        if (in_array($workID, array_keys($this->workRelations))) return $this->workRelations[$workID];
        return null;
    }

    /**
     * Get the work with the given workID
     * @param int $workID ID of the work
     * @return Work|null Work or *null* if Work not related
     * @throws Exception
     */
    public function getWork(int $workID): ?Work {
        $this->getWorks();
        if (in_array($workID, array_keys($this->works))) return $this->works[$workID];
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
        if (!is_null($this->workRelations) and !empty($this->workRelations)) {
            $inserted = Dao::exhHasWorkDao()->insertBatch($this->workRelations);
            $relationCount = count($inserted);
        }
        return $relationCount;
    }

}