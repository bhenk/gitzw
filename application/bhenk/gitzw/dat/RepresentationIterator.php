<?php

namespace bhenk\gitzw\dat;

use function array_values;
use function count;

class RepresentationIterator {
    private array $representations = [];
    private int $count = 0;
    private int $total = 0;
    private int $offset = 0;
    private int $limit = 10;

    function __construct(private readonly string $where = "1=1") {
    }

    public function hasNext(): bool {
        if (empty($this->representations) || $this->count >= ($this->limit)) {
            $this->loadMore();
        }
        return $this->count < count($this->representations);
    }

    public function next(): Representation|bool {
        if ($this->hasNext()) {
            return $this->representations[$this->count++];
        } else {
            return false;
        }
    }

    private function loadMore(): void {
        $this->total += count($this->representations);
        $this->representations =
            array_values(Store::representationStore()->selectWhere($this->where, $this->offset, $this->limit));
        $this->offset += $this->limit;
        $this->count = 0;
    }

    public function getCount(): int {
        return $this->total + $this->count;
    }
}