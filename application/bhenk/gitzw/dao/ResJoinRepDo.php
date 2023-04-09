<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\Join;

class ResJoinRepDo extends Join {

    public function __construct(
        ?int            $ID = null,
        ?int            $FK_LEFT = null,
        ?int            $FK_RIGHT = null,
        bool            $deleted = false,
        private ?string $description = null,
        private bool    $hidden = false,
        private bool    $preferred = false,
        private int     $ordinal = -1) {
        parent::__construct($ID, $FK_LEFT, $FK_RIGHT, $deleted);
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


}