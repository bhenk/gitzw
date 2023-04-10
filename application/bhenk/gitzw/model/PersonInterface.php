<?php

namespace bhenk\gitzw\model;

interface PersonInterface {

    public function getCRID(): ?string;

    public function setCRID(?string $CRID): void;

    public function getFirstname(): ?string;

    public function setFirstname(?string $firstname): void;

    public function getPrefixes(): ?string;

    public function setPrefixes(?string $prefixes): void;

    public function getLastname(): ?string;

    public function setLastname(?string $lastname): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getUrl(): ?string;

    public function setUrl(?string $url): void;

    public function getSameAs(): ?string;

    public function setSameAs(?string $sameAs): void;

}