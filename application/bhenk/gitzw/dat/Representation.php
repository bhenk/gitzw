<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\RepresentationDo;

class Representation extends AbstractStoredObject {

    function __construct(private readonly RepresentationDo $repDo = new RepresentationDo()) {
    }

    public function getID(): ?int {
        return $this->repDo->getID();
    }

    /**
     * @return string|null
     */
    public function getREPID(): ?string {
        return $this->repDo->getREPID();
    }

    /**
     * @param string $REPID
     */
    public function setREPID(string $REPID): void {
        $this->repDo->setREPID($REPID);
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string {
        return $this->repDo->getSource();
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void {
        $this->repDo->setSource($source);
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->repDo->getDescription();
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->repDo->setDescription($description);
    }

    /**
     * @return RepresentationDo
     */
    public function getRepresentationDo(): RepresentationDo {
        return $this->repDo;
    }

}