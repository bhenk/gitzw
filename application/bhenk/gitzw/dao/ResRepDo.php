<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\Entity;

class ResRepDo extends Entity {

    function __construct(?int         $ID = null,
                         private ?int $resourceID = null,
                         private ?int $representationID = null,
                         private int  $ordinal = -1,
                         private bool $hidden = false,
                         private bool $preferred = false,
                         private bool $deleted = false
    ) {
        parent::__construct($ID);
    }

    /**
     * @return int|null
     */
    public function getResourceID(): ?int {
        return $this->resourceID;
    }

    /**
     * @param int|null $resourceID
     */
    public function setResourceID(?int $resourceID): void {
        $this->resourceID = $resourceID;
    }

    /**
     * @return int|null
     */
    public function getRepresentationID(): ?int {
        return $this->representationID;
    }

    /**
     * @param int|null $representationID
     */
    public function setRepresentationID(?int $representationID): void {
        $this->representationID = $representationID;
    }

    /**
     * @return int
     */
    public function getOrdinal(): int {
        return $this->ordinal;
    }

    /**
     * @param int $ordinal
     */
    public function setOrdinal(int $ordinal): void {
        $this->ordinal = $ordinal;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void {
        $this->hidden = $hidden;
    }

    /**
     * @return bool
     */
    public function isPreferred(): bool {
        return $this->preferred;
    }

    /**
     * @param bool $preferred
     */
    public function setPreferred(bool $preferred): void {
        $this->preferred = $preferred;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void {
        $this->deleted = $deleted;
    }

}