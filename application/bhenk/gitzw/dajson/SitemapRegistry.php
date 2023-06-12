<?php

namespace bhenk\gitzw\dajson;

use bhenk\gitzw\base\Env;
use function array_keys;
use function file_get_contents;
use function file_put_contents;
use function in_array;
use function is_null;
use function json_decode;
use function json_encode;

class SitemapRegistry {

    /** @var SitemapEntry[] $entries */
    private array $entries = [];

    function __construct() {
        $entryData = $this->load();
        foreach ($entryData["sm_entries"] as $path => $data) {
            $entry = new SitemapEntry($path, $data);
            $this->entries[$path] = $entry;
        }
    }

    public function serialize(): string {
        return json_encode(["sm_entries" => $this->entries], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function persist(): void {
        file_put_contents($this->getFilename(), $this->serialize(), LOCK_EX);
    }

    public function getEntryByPath(string $path): SitemapEntry {
        if (!in_array($path, array_keys($this->entries))) {
            $entry = new SitemapEntry($path, []);
            $this->entries[$path] = $entry;
        }
        return $this->entries[$path];
    }

    public function getEntries(): array {
        return $this->entries;
    }

    public function exists(string $path): bool {
        return in_array($path, array_keys($this->entries));
    }

    public function removeEntry(string $path): bool {
        if ($this->exists($path)) {
            unset($this->entries[$path]);
            return true;
        }
        return false;
    }

    public function getFilename(): string {
        return Env::dataDir() . DIRECTORY_SEPARATOR . "sitemap" . DIRECTORY_SEPARATOR . "entries.json";
    }

    private function load(): array {
        $data = json_decode(file_get_contents($this->getFilename()), true);
        if (is_null($data)) return [];
        return $data;
    }
}