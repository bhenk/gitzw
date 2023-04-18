<?php

namespace bhenk\gitzw\model;


interface StoredObjectInterface extends JsonAwareInterface {

    /**
     * Get the ID of this JsonAware
     *
     * @return int|null ID or *null* if this JsonAware does not have an ID yet
     */
    public function getID(): ?int;

}