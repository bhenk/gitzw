<?php

namespace bhenk\gitzw\dao;

use bhenk\gitzw\model\PersonInterface;
use bhenk\msdata\abc\Entity;

class CreatorDo extends Entity implements PersonInterface {

    function __construct(?int            $ID = null,
                         private ?string $CRID = null,
                         private ?string $firstname = null,
                         private ?string $prefixes = null,
                         private ?string $lastname = null,
                         private ?string $description = null,
                         private ?string $url = null,
                         private ?string $sameAs = null) {
        parent::__construct($ID);
    }

    /**
     * @return string|null
     */
    public function getCRID(): ?string {
        return $this->CRID;
    }

    /**
     * @param string|null $CRID
     */
    public function setCRID(?string $CRID): void {
        $this->CRID = $CRID;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void {
        $this->firstname = $firstname;
    }

    /**
     * @return string|null
     */
    public function getPrefixes(): ?string {
        return $this->prefixes;
    }

    /**
     * @param string|null $prefixes
     */
    public function setPrefixes(?string $prefixes): void {
        $this->prefixes = $prefixes;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void {
        $this->lastname = $lastname;
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
    public function getUrl(): ?string {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void {
        $this->url = $url;
    }

    /**
     * @return string|null
     */
    public function getSameAs(): ?string {
        return $this->sameAs;
    }

    /**
     * @param string|null $sameAs
     */
    public function setSameAs(?string $sameAs): void {
        $this->sameAs = $sameAs;
    }

}