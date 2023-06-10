<?php

namespace bhenk\gitzw\dat;

use function array_values;
use function count;

class WorkIterator {

    private array $works = [];
    private int $count = 0;
    private int $total = 0;
    private int $offset = 0;
    private int $limit = 10;

    function __construct(private readonly string $where = "1=1") {}

    public function hasNext(): bool {
        if (empty($this->works) || $this->count >= ($this->limit)) {
            $this->loadMore();
        }
        return $this->count < count($this->works);
    }

    public function next(): Work|bool {
        if ($this->hasNext()) {
            return $this->works[$this->count++];
        } else {
            return false;
        }
    }

    private function loadMore(): void {
        $this->total += count($this->works);
        $this->works = array_values(Store::workStore()->selectWhere($this->where, $this->offset, $this->limit));
        $this->offset += $this->limit;
        $this->count = 0;
    }

    public function getCount(): int {
        return $this->total + $this->count;
    }

}