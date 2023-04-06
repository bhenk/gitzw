<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\Entity;

class RepresentationDo extends Entity {

    function __construct(?int            $ID = null,
                         private ?string $REPID = null,
                         private ?string $source = null,
                         private ?string $description = null
    ) {
        parent::__construct($ID);
    }

    /**
     * @return string|null
     */
    public function getREPID(): ?string {
        return $this->REPID;
    }

    /**
     * @param string|null $REPID
     */
    public function setREPID(?string $REPID): void {
        $this->REPID = $REPID;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string {
        return $this->source;
    }

    /**
     * @param string|null $source
     */
    public function setSource(?string $source): void {
        $this->source = $source;
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

}