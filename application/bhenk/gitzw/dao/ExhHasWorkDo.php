<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\Join;

class ExhHasWorkDo extends Join {

    function __construct(?int            $ID = null,
                         ?int            $FK_LEFT = null,
                         ?int            $FK_RIGHT = null,
                         bool            $deleted = false,
                         private int     $ordinal = -1,
                         private ?string $reprIDs = null,
                         private ?string $description = null,
                         private bool    $hidden = false,
    ) {
        parent::__construct($ID, $FK_LEFT, $FK_RIGHT, $deleted);
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
     * @return string|null
     */
    public function getReprIDs(): ?string {
        return $this->reprIDs;
    }

    /**
     * @param string|null $reprIDs
     */
    public function setReprIDs(?string $reprIDs): void {
        $this->reprIDs = $reprIDs;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
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

}