<?php

namespace bhenk\gitzw\dat;

abstract class AbstractStoredObject {

    public static abstract function deserialize(string $serialized): AbstractStoredObject;

    public abstract function serialize(): string;

    public abstract function getID(): ?int;
}