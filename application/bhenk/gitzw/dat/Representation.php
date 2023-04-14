<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\model\DateTrait;
use ReflectionException;
use function json_decode;
use function json_encode;

/**
 * A Representation represents a manifestation of a Resource
 */
class Representation extends AbstractStoredObject {
    use DateTrait;

    private RepresentationRelations $relations;

    function __construct(private readonly RepresentationDo $repDo = new RepresentationDo()) {
        $this->initDateTrait($this->repDo);
        $this->relations = new RepresentationRelations($this->getID());
    }

    public function getID(): ?int {
        return $this->repDo->getID();
    }

    public function serialize(): string {
        return json_encode(["representationDo" => $this->repDo->toArray()],
            JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    /**
     * @throws ReflectionException
     */
    public static function deserialize(string $serialized): Representation {
        $array = json_decode($serialized, true);
        return new Representation(RepresentationDo::fromArray($array["representationDo"]));
    }

    /**
     * @return string|null
     */
    public function getREPID(): ?string {
        return $this->repDo->getREPID();
    }

    /**
     * @param string $REPID
     */
    public function setREPID(string $REPID): void {
        $this->repDo->setREPID($REPID);
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string {
        return $this->repDo->getSource();
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void {
        $this->repDo->setSource($source);
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->repDo->getDescription();
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->repDo->setDescription($description);
    }

    /**
     * @return RepresentationDo
     */
    public function getRepresentationDo(): RepresentationDo {
        return $this->repDo;
    }

    /**
     * @return RepresentationRelations
     */
    public function getRelations(): RepresentationRelations {
        return $this->relations;
    }

}