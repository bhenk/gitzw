<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ExhHasRepDo;
use bhenk\gitzw\dao\ExhibitionDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\MultiLanguageTitleTrait;
use bhenk\gitzw\model\StoredObjectInterface;
use Exception;
use ReflectionException;
use function json_decode;

class Exhibition implements StoredObjectInterface {
    use MultiLanguageTitleTrait;
    use DateTrait;

    private ExhibitionRelations $relations;

    function __construct(private readonly ExhibitionDo $exhibitionDo = new ExhibitionDo(),
                         ?array                        $workRelations = null
    ) {
        $this->initTitleTrait($this->exhibitionDo);
        $this->initDateTrait($this->exhibitionDo);
        $this->relations = new ExhibitionRelations($this->getID(), $workRelations);
    }

    /**
     * @inheritDoc
     */
    public function getID(): ?int {
        return $this->exhibitionDo->getID();
    }

    /**
     * @inheritDoc
     * @throws ReflectionException
     */
    public static function deserialize(string $serialized): Exhibition {
        $array = json_decode($serialized, true);
        $exhibitionArray = $array["exhibition"];
        $exhibitionDo = ExhibitionDo::fromArray($exhibitionArray["exhibitionDo"]);
        $rels = $exhibitionArray["exhHasRep"];
        $repRelations = [];
        foreach ($rels as $relation) {
            $exhHasWorkDo = ExhHasRepDo::fromArray($relation);
            $repRelations[$exhHasWorkDo->getFkRight()] = $exhHasWorkDo;
        }
        return new Exhibition($exhibitionDo, $repRelations);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function serialize(): string {
        $array = ["exhibitionDo" => $this->exhibitionDo->toArray()];
        $rels = [];
        foreach ($this->relations->getRepRelations() as $exhHasRepDo) {
            $exhHasRepDo->setFkLeft($this->getID());
            $rels[$exhHasRepDo->getFkRight()] = $exhHasRepDo->toArray();
        }
        $array["exhHasRep"] = $rels;
        return json_encode(["exhibition" => $array], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return string|null
     */
    public function getEXHID(): ?string {
        return $this->exhibitionDo->getEXHID();
    }

    /**
     * @param string $EXHID
     */
    public function setEXHID(string $EXHID): void {
        $this->exhibitionDo->setEXHID($EXHID);
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->exhibitionDo->getDescription();
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->exhibitionDo->setDescription($description);
    }

    /**
     * @return string|null
     */
    public function getSubtitle(): ?string {
        return $this->exhibitionDo->getSubtitle();
    }

    /**
     * @param string|null $subtitle
     */
    public function setSubtitle(?string $subtitle): void {
        $this->exhibitionDo->setSubtitle($subtitle);
    }

    /**
     * @return ExhibitionRelations
     */
    public function getRelations(): ExhibitionRelations {
        return $this->relations;
    }

    /**
     * @return ExhibitionDo
     */
    public function getExhibitionDo(): ExhibitionDo {
        return $this->exhibitionDo;
    }

}