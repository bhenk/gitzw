<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\Join;

class ExhHasWorkDo extends Join {

    function __construct(?int            $ID = null,
                         ?int            $FK_LEFT = null,
                         ?int            $FK_RIGHT = null,
                         bool            $deleted = false,
                         private int     $ordinal = -1,
                         private ?int    $reprID = null,
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
     * @return int|null
     */
    public function getReprID(): ?int {
        return $this->reprID;
    }

    /**
     * @param int|null $reprID
     */
    public function setReprID(?int $reprID): void {
        $this->reprID = $reprID;
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