<?php

namespace bhenk\gitzw\dajson;

use DateTime;
use JsonSerializable;

class SitemapEntry implements JsonSerializable {

    private string $lastModified;
    private string $sha1;

    function __construct(private string $path, array $data) {
        $this->lastModified = $data["last_modified"] ?? "";
        $this->sha1 = $data["sha1"] ?? "";
    }

    public function getPath(): string {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getLastModified(): string {
        return $this->lastModified;
    }

    /**
     * @return string
     */
    public function getSha1(): string {
        return $this->sha1;
    }

    /**
     * @param string $sha1
     * @return bool
     */
    public function setSha1(string $sha1): bool {
        if ($sha1 != $this->sha1) {
            $this->sha1 = $sha1;
            $this->lastModified = (new DateTime())->format("Y-m-d H:i:s");
            return true;
        }
        return false;
    }

    public function jsonSerialize(): array {
        return [
            "last_modified" => $this->lastModified,
            "sha1" => $this->sha1,
        ];
    }
}