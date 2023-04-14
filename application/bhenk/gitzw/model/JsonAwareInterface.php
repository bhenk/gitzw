<?php

namespace bhenk\gitzw\model;

/**
 * A JsonAware object is capable of complete serialization and deserialization
 */
abstract class JsonAwareInterface {

    /**
     * Deserialize the object from the given json string
     *
     * @param string $serialized json string
     * @return JsonAwareInterface rebirth of the serialized object
     */
    public static abstract function deserialize(string $serialized): JsonAwareInterface;

    /**
     * Serialize this to a json string
     *
     * @return string json string
     */
    public abstract function serialize(): string;

    /**
     * Get the ID of this JsonAware
     *
     * @return int|null ID or *null* if this JsonAware does not have an ID yet
     */
    public abstract function getID(): ?int;
}