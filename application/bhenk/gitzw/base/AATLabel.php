<?php

namespace bhenk\gitzw\base;

use JsonSerializable;

class AATLabel implements JsonSerializable {

    function __construct(private string  $language,
                         private string  $literal,
                         private string  $type,
                         private bool    $displayed = true) {}

    /**
     * @return string
     */
    public function getLanguage(): string {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getLiteral(): string {
        return $this->literal;
    }

    /**
     * @param string $literal
     */
    public function setLiteral(string $literal): void {
        $this->literal = $literal;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isDisplayed(): bool {
        return $this->displayed;
    }

    /**
     * @param bool $displayed
     */
    public function setDisplayed(bool $displayed): void {
        $this->displayed = $displayed;
    }


    public function jsonSerialize(): array {
        return [
            "language" => $this->language,
            "literal" => $this->literal,
            "type" => $this->type,
            "displayed" => $this->displayed
        ];
    }
}