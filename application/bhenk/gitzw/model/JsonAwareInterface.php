<?php

namespace bhenk\gitzw\model;

/**
 * A JsonAware object is capable of complete serialization and deserialization
 */
interface JsonAwareInterface {

    /**
     * Deserialize the object from the given json string
     *
     * @param string $serialized json string
     * @return JsonAwareInterface rebirth of the serialized object
     */
    public static function deserialize(string $serialized): JsonAwareInterface;

    /**
     * Serialize this to a json string
     *
     * @return string json string
     */
    public function serialize(): string;
}