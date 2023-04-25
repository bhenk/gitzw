<?php

namespace bhenk\gitzw\model;

use function explode;
use function implode;
use function is_null;
use function json_encode;
use function str_replace;
use function trim;

trait PersonTrait {

    private PersonInterface $person;

    public function initPersonTrait(PersonInterface $person): void {
        $this->person = $person;
    }

    /**
     * @param string|null $CRID
     */
    public function setCRID(?string $CRID): void {
        $this->person->setCRID($CRID);
    }

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void {
        $this->person->setFirstname($firstname);
    }

    /**
     * @param string|null $prefixes
     */
    public function setPrefixes(?string $prefixes): void {
        $this->person->setPrefixes($prefixes);
    }

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void {
        $this->person->setLastname($lastname);
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->person->setDescription($description);
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void {
        $this->person->setUrl($url);
    }

    public function setSameAs(array $sameAs): void {
        if (empty($sameAs)) {
            $this->person->setSameAs(null);
        } else {
            $this->person->setSameAs(implode(";", $sameAs));
        }
    }

    /**
     * Gets the SD-Card of this Person
     *
     * ```
     * {
     *     "@context": "http://schema.org",
     *     "@graph": [
     *         {
     *             "@type": "Person",
     *             "@id": "{CRID}",
     *             "url": "{url}",
     *             "name": "{fullName}",
     *             "description": "{description}",
     *             "sameAs": [
     *                 "{sameAs}"
     *             ]
     *         }
     *     ]
     * }
     * ```
     *
     * @return string
     */
    public function getSDCard(): string {
        return json_encode([
            "@context" => "http://schema.org",
            "@graph" => [$this->getStructuredData()]
        ], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function getStructuredData(): array {
        return [
            "@type" => "Person",
            "@id" => $this->getCRID(),
            "url" => $this->getUrl(),
            "name" => $this->getFullName(),
            "description" => $this->getDescription(),
            "sameAs" => $this->getSameAs(),
        ];
    }

    /**
     * @return string|null
     */
    public function getCRID(): ?string {
        return $this->person->getCRID();
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string {
        return $this->person->getUrl();
    }

    public function getFullName(): string {
        $fullName = "";
        if (!is_null($this->getFirstname())) $fullName .= $this->getFirstname();
        if (!is_null($this->getPrefixes())) $fullName .= " " . $this->getPrefixes();
        if (!is_null($this->getLastname())) $fullName .= " " . $this->getLastname();
        return trim($fullName);
    }

    public function getUriName(): string {
        return str_replace(" ", "-", $this->getFullName());
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string {
        return $this->person->getFirstname();
    }

    /**
     * @return string|null
     */
    public function getPrefixes(): ?string {
        return $this->person->getPrefixes();
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string {
        return $this->person->getLastname();
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->person->getDescription();
    }

    public function getSameAs(): array {
        if (is_null($this->person->getSameAs())) {
            return [];
        } else {
            return explode(";", $this->person->getSameAs());
        }
    }

    public function getStructuredDataShort(): array {
        return [
            "@type" => "Person",
            "@id" => $this->getCRID(),
            "url" => $this->getUrl(),
            "name" => $this->getFullName(),
        ];
    }

}