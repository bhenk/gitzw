<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\model\PersonTrait;
use ReflectionException;
use function json_decode;
use function json_encode;

class Creator extends AbstractStoredObject {
    use PersonTrait;

    function __construct(private readonly CreatorDo $creatorDo = new CreatorDo()) {
        $this->initPersonTrait($this->creatorDo);
    }

    /**
     * @param string $serialized
     * @return Creator
     * @throws ReflectionException
     */
    public static function deserialize(string $serialized): Creator {
        $array = json_decode($serialized, true);
        return new Creator(CreatorDo::fromArray($array["creatorDo"]));
    }

    public function getID(): ?int {
        return $this->creatorDo->getID();
    }

    public function serialize(): string {
        return json_encode(["creatorDo" => $this->creatorDo->toArray()], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return CreatorDo
     */
    public function getCreatorDo(): CreatorDo {
        return $this->creatorDo;
    }


}