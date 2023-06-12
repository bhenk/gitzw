<?php

namespace bhenk\gitzw\dajson;

use DateTime;
use JsonSerializable;
use function array_key_last;
use function array_keys;
use function date;

class Action implements JsonSerializable {

    private string $name;
    private string $location;
    private string $path;
    private array $modified;

    function __construct(private readonly string $ACID, array $data) {
        $this->name = $data["name"] ?? "";
        $this->location = $data["location"] ?? "";
        $this->path = $data["path"] ?? "";
        $this->modified = $data["modified"] ?? [];
    }

    public function getACID(): string {
        return $this->ACID;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLocation(): string {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getPath(): string {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getModified(): array {
        return $this->modified;
    }

    public function getLastModified(): DateTime|bool {
        if (empty($this->modified)) return false;
        $keys = array_keys($this->modified);
        return new DateTime(date($keys[array_key_last($keys)]));
    }

    public function getLastModifiedBy(): string|bool {
        return end($this->modified);
    }

    public function getLastModifiedToString(): string {
        $lm = $this->getLastModified();
        if (!$lm) return "unknown";
        return $lm->format("Y-m-d H:i:s");
    }

    public function setLastModified(string $byUser): void {
        $this->modified[(new DateTime())->format("Y-m-d H:i:s")] = $byUser;
    }

    public function jsonSerialize(): array {
        return [
            "name" => $this->name,
            "location" => $this->location,
            "path" => $this->path,
            "modified" => $this->modified,
        ];
    }
}