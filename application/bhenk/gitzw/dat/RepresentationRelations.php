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
    private ?array $works = null;

    function __construct(private readonly ?int $representationId) {
    }

    /**
     * @param int $workId
     * @return WorkHasRepDo|null
     * @throws Exception
     */
    public function getRelation(int $workId): ?WorkHasRepDo {
        $this->getRelations();
        if (in_array($workId, array_keys($this->relations))) return $this->relations[$workId];
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
            $relations = $this->getRelations();
            if (!empty($relations)) {
                $this->works = Store::workStore()->selectBatch(array_keys($relations));
            }
        }
        return $this->works;
    }

}