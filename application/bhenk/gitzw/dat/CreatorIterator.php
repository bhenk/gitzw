<?php

namespace bhenk\gitzw\dat;

use function array_values;
use function count;

class CreatorIterator {
    private array $creators = [];
    private int $count = 0;
    private int $total = 0;
    private int $offset = 0;
    private int $limit = 10;

    function __construct(private readonly string $where = "1=1") {}

    public function hasNext(): bool {
        if (empty($this->creators) || $this->count > ($this->limit -1)) {
            $this->loadMore();
        }
        return $this->count < count($this->creators);
    }

    public function next(): Creator|bool {
        if ($this->hasNext()) {
            return $this->creators[$this->count++];
        } else {
            return false;
        }
    }

    private function loadMore(): void {
        $this->total += count($this->creators);
        $this->creators = array_values(Store::creatorStore()->selectWhere($this->where, $this->offset, $this->limit));
        $this->offset += $this->limit;
        $this->count = 0;
    }

    public function getCount(): int {
        return $this->total + $this->count;
    }
}