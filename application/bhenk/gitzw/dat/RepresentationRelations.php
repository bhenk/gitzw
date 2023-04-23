<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ExhHasRepDo;
use bhenk\gitzw\dao\WorkHasRepDo;
use Exception;
use function array_keys;
use function in_array;
use function is_null;

/**
 * Keeps track of work and exhibition relations for the owner Representation
 */
class RepresentationRelations {

    /** @var WorkHasRepDo[]|null */
    private ?array $workRelations = null;

    /** @var ExhHasRepDo[]|null */
    private ?array $exhibitionRelations = null;

    /** @var Work[]|null */
    private ?array $works = null;

    /** @var Exhibition[]|null */
    private ?array $exhibitions = null;

    function __construct(private readonly ?int $representationId) {
    }

    /**
     * Reset relations
     *
     * Forces this object to nullify works, work relations, exhibitions and exhibition relations,
     * effectively forcing it to fetch said collections anew from database when requested.
     *
     * @return void
     */
    public function resetRelations(): void {
        $this->workRelations = null;
        $this->works = null;
        $this->exhibitionRelations = null;
        $this->exhibitions = null;
    }

    /**
     * Get the work relation for the given Work ID
     *
     * @param int $workId ID of Work
     * @return WorkHasRepDo|null work relation or *null* if no such relation exists
     * @throws Exception
     */
    public function getWorkRelation(int $workId): ?WorkHasRepDo {
        $this->getWorkRelations();
        if (in_array($workId, array_keys($this->workRelations))) return $this->workRelations[$workId];
        return null;
    }

    /**
     * Get all work relations of the owner Representation
     * @return array|WorkHasRepDo[] array<workID, WorkHasRepDo> with workID as key
     * @throws Exception
     */
    public function getWorkRelations(): array {
        if (is_null($this->workRelations)) {
            if (is_null($this->representationId)) {
                $this->workRelations = [];
            } else {
                $this->workRelations = Dao::workHasRepDao()->selectRight($this->representationId);
            }
        }
        return $this->workRelations;
    }

    /**
     * Get the exhibition relation for the given Exhibition ID
     * @param int $exhibitionID ID of Exhibition
     * @return ExhHasRepDo|null exhibition relation or *null* if no such relation exists
     * @throws Exception
     */
    public function getExhibitionRelation(int $exhibitionID): ?ExhHasRepDo {
        $this->getExhibitionRelations();
        if (in_array($exhibitionID, array_keys($this->exhibitionRelations)))
            return $this->exhibitionRelations[$exhibitionID];
        return null;
    }

    /**
     * Get all exhibition relations of the owner Representation
     *
     * @return ExhHasRepDo[] array<exhibitionID, ExhHasRepDo> with exhibitionID as key
     * @throws Exception
     */
    public function getExhibitionRelations(): array {
        if (is_null($this->exhibitionRelations)) {
            if (is_null($this->representationId)) {
                $this->exhibitionRelations = [];
            } else {
                $this->exhibitionRelations = Dao::exhHasRepDao()->selectRight($this->representationId);
            }
        }
        return $this->exhibitionRelations;
    }

    /**
     * Get the Work with the given ID related to this Representation
     * @param int $workId ID of Work
     * @return Work|null Work or *null* if no relation exists
     * @throws Exception
     */
    public function getWork(int $workId): ?Work {
        $this->getWorks();
        if (in_array($workId, array_keys($this->works))) return $this->works[$workId];
        return null;
    }

    /**
     * Get all Works related to this Representation
     * @return Work[] array<workId, Work> with workId as key
     * @throws Exception
     */
    public function getWorks(): array {
        if (is_null($this->works)) {
            $relations = $this->getWorkRelations();
            if (!empty($relations)) {
                $this->works = Store::workStore()->selectBatch(array_keys($relations));
            } else {
                $this->works = [];
            }
        }
        return $this->works;
    }

    /**
     * Get the Exhibition with the given ID related to this Representation
     * @param int $exhibitionID ID of Exhibition
     * @return Exhibition|null Exhibition or *null* if no relation exists
     * @throws Exception
     */
    public function getExhibition(int $exhibitionID): ?Exhibition {
        $this->getExhibitions();
        if (in_array($exhibitionID, array_keys($this->exhibitions))) return $this->exhibitions[$exhibitionID];
        return null;
    }

    /**
     * Get all Exhibitions related to this Representation
     * @return array|Exhibition[] array<exhibitionId, Exhibition> with exhibitionId as key
     * @throws Exception
     */
    public function getExhibitions(): array {
        if (is_null($this->exhibitions)) {
            $relations = $this->getExhibitionRelations();
            if (!empty($relations)) {
                $this->exhibitions = Store::exhibitionStore()->selectBatch(array_keys($relations));
            } else {
                $this->exhibitions = [];
            }
        }
        return $this->exhibitions;
    }

}