<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\WorkHasRepDo;

class WorkRepresentation {

    function __construct(private readonly WorkHasRepDo   $workHasRepDo,
                         private readonly Representation $representation) {}

    /**
     * @return Representation
     */
    public function getRepresentation(): Representation {
        return $this->representation;
    }

    public function getFileLocation(array $dimensions): string {
        return $this->representation->getFileLocation($dimensions);
    }

    public function getOrdinal(): int {
        $ordinal = $this->workHasRepDo->getOrdinal();
        return $ordinal < 1 ? PHP_INT_MAX : $ordinal;
    }

    public function getDescription(): ?string {
        return $this->workHasRepDo->getDescription();
    }

    public function isPreferred(): bool {
        return $this->workHasRepDo->isPreferred();
    }


}