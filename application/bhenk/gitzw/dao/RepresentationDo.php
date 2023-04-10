<?php

namespace bhenk\gitzw\dao;

use bhenk\gitzw\model\DateInterface;
use bhenk\msdata\abc\Entity;

class RepresentationDo extends Entity implements DateInterface {

    function __construct(?int            $ID = null,
                         private ?string $REPID = null,
                         private ?string $source = null,
                         private ?string $description = null,
                         private ?string $date = null,
                         private ?string $d_format = null,
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

    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getDateFormat(): ?string {
        return $this->d_format;
    }

    /**
     * @param string|null $d_format
     */
    public function setDateFormat(?string $d_format): void {
        $this->d_format = $d_format;
    }


}