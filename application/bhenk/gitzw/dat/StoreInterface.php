<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\model\ProgressListener;

interface StoreInterface {

    public function getName(): string;

    public function serialize(string $datastore, ProgressListener $pl): array;

    public function deSerialize(string $datastore, ProgressListener $pl): array;

    /**
     * Get total number of stored objects
     * @return int
     */
    public function getObjectCount(): int;

}