<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\model\PersonTrait;
use bhenk\gitzw\model\StoredObjectInterface;
use Exception;
use ReflectionException;
use function is_null;
use function json_decode;
use function json_encode;
use function substr;

class Creator implements StoredObjectInterface {
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

    public function serialize(): string {
        return json_encode(["creatorDo" => $this->creatorDo->toArray()], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function getID(): ?int {
        return $this->creatorDo->getID();
    }

    public function getShortCRID(): ?string {
        $crid = $this->creatorDo->getCRID();
        if (is_null($crid)) return null;
        return substr($crid, strrpos($crid, "/") + 1);
    }

    /**
     * @return CreatorDo
     */
    public function getCreatorDo(): CreatorDo {
        return $this->creatorDo;
    }

    /**
     * Get Works by this Creator
     * @param int $offset start index
     * @param int $limit max number of Works to return
     * @return array<int, Work> array of Works or empty array if end of storage reached
     * @throws Exception
     */
    public function getWorks(int $offset = 0, int $limit = PHP_INT_MAX): array {
        return Store::workStore()->selectByCreator($this, $offset, $limit);
    }

}