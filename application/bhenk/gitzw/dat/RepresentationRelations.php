<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\ExhHasRepDo;
use bhenk\gitzw\dao\WorkHasRepDo;
use Exception;
use function array_keys;
use function in_array;
use function is_null;

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

    public function resetRelations(): void {
        $this->workRelations = null;
        $this->works = null;
        $this->exhibitionRelations = null;
        $this->exhibitions = null;
    }

    /**
     * @param int $workId
     * @return WorkHasRepDo|null
     * @throws Exception
     */
    public function getWorkRelation(int $workId): ?WorkHasRepDo {
        $this->getWorkRelations();
        if (in_array($workId, array_keys($this->workRelations))) return $this->workRelations[$workId];
        return null;
    }

    /**
     * @return array|WorkHasRepDo[]
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
     * @param int $exhibitionID
     * @return ExhHasRepDo|null
     * @throws Exception
     */
    public function getExhibitionRelation(int $exhibitionID): ?ExhHasRepDo {
        $this->getExhibitionRelations();
        if (in_array($exhibitionID, array_keys($this->exhibitionRelations)))
            return $this->exhibitionRelations[$exhibitionID];
        return null;
    }

    /**
     * @return ExhHasRepDo[]|null
     * @throws Exception
     */
    public function getExhibitionRelations(): ?array {
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
     * @param int $workId
     * @return Work|null
     * @throws Exception
     */
    public function getWork(int $workId): ?Work {
        $this->getWorks();
        if (in_array($workId, array_keys($this->works))) return $this->works[$workId];
        return null;
    }

    /**
     * @return Work[]
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
     * @param int $exhibitionID
     * @return Exhibition|null
     * @throws Exception
     */
    public function getExhibition(int $exhibitionID): ?Exhibition {
        $this->getExhibitions();
        if (in_array($exhibitionID, array_keys($this->exhibitions))) return $this->exhibitions[$exhibitionID];
        return null;
    }

    /**
     * @return array|Exhibition[]
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