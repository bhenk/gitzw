<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\Entity;

class ResRepDo extends Entity {

    function __construct(?int         $ID = null,
                         private ?int $RESID = null,
                         private ?int $REPID = null,
                         private int  $ordinal = -1,
                         private bool $hidden = false,
                         private bool $preferred = false
    ) {
        parent::__construct($ID);
    }

    /**
     * @return int|null
     */
    public function getRESID(): ?int {
        return $this->RESID;
    }

    /**
     * @param int|null $RESID
     */
    public function setRESID(?int $RESID): void {
        $this->RESID = $RESID;
    }

    /**
     * @return int|null
     */
    public function getREPID(): ?int {
        return $this->REPID;
    }

    /**
     * @param int|null $REPID
     */
    public function setREPID(?int $REPID): void {
        $this->REPID = $REPID;
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

}