<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\dao\WorkHasRepDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\DimensionsTrait;
use bhenk\gitzw\model\MultiLanguageTitleTrait;
use bhenk\gitzw\model\StoredObjectInterface;
use bhenk\gitzw\model\WorkCategories;
use Exception;
use ReflectionException;
use function is_null;
use function json_decode;
use function json_encode;

/**
 * A Work in gitzwart is something that can be represented by one or more images aka Representations
 *
 */
class Work implements StoredObjectInterface {
    use MultiLanguageTitleTrait;
    use DimensionsTrait;
    use DateTrait;

    private WorkRelations $relations;

    function __construct(private readonly WorkDo $workDo = new WorkDo(),
                         ?array                  $representationRelations = null) {
        $this->initTitleTrait($this->workDo);
        $this->initDimensionsTrait($this->workDo);
        $this->initDateTrait($this->workDo);
        $this->relations = new WorkRelations($this->getID(), $representationRelations);
    }

    /**
     * @return int|null
     */
    public function getID(): ?int {
        return $this->workDo->getID();
    }

    /**
     * @throws ReflectionException
     */
    public static function deserialize(string $serialized): Work {
        $array = json_decode($serialized, true);
        $workArray = $array["work"];
        $workDo = WorkDo::fromArray($workArray["workDo"]);
        $rels = $workArray["workHasRep"];
        $representationRelations = [];
        foreach ($rels as $relation) {
            $resJoinRepDo = WorkHasRepDo::fromArray($relation);
            $representationRelations[$resJoinRepDo->getFkRight()] = $resJoinRepDo;
        }
        return new Work($workDo, $representationRelations);
    }

    /**
     * @throws Exception
     */
    public function serialize(): string {
        $array = ["workDo" => $this->workDo->toArray()];
        $rels = [];
        foreach ($this->relations->getRepRelations() as $resJoinRepDo) {
            $resJoinRepDo->setFkLeft($this->getID());
            $rels[$resJoinRepDo->getFkRight()] = $resJoinRepDo->toArray();
        }
        $array["workHasRep"] = $rels;
        return json_encode(["work" => $array], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return WorkRelations
     */
    public function getRelations(): WorkRelations {
        return $this->relations;
    }

    public function getRESID(): ?string {
        return $this->workDo->getRESID();
    }

    /**
     * @param string $RESID
     */
    public function setRESID(string $RESID): void {
        $this->workDo->setRESID($RESID);
    }

    /**
     * @return string|null
     */
    public function getMedia(): ?string {
        return $this->workDo->getMedia();
    }

    /**
     * @param string $media
     */
    public function setMedia(string $media): void {
        $this->workDo->setMedia($media);
    }

    /**
     * @return bool
     */
    public function isHidden(): bool {
        return $this->workDo->getHidden() ?? false;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void {
        $this->workDo->setHidden($hidden);
    }

    /**
     * @return int
     */
    public function getOrdinal(): int {
        return $this->workDo->getOrdinal();
    }

    /**
     * @param int $ordinal
     */
    public function setOrdinal(int $ordinal): void {
        $this->workDo->setOrdinal($ordinal);
    }

    /**
     * @return WorkCategories|null
     */
    public function getCategory(): ?WorkCategories {
        return WorkCategories::forName($this->workDo->getCategory());
    }

    /**
     * @param string|WorkCategories $category
     * @return bool
     */
    public function setCategory(string|WorkCategories $category): bool {
        if ($category instanceof WorkCategories) {
            $this->workDo->setCategory($category->name);
            return true;
        } else {
            $cat = WorkCategories::forName($category) ?? WorkCategories::forValue($category);
            if ($cat) {
                $this->workDo->setCategory($cat->name);
                return true;
            }
        }
        return false;
    }

    /**
     * @param int|string|Creator|null $creator
     * @return bool|Creator
     * @throws Exception
     */
    public function setCreator(int|string|Creator|null $creator): bool|Creator {
        if (is_null($creator)) {
            $this->workDo->setCreatorId(null);
            return true;
        }
        $creator = Store::creatorStore()->get($creator);
        if (!$creator) return false;
        $creatorId = $creator->getID();
        if (is_null($creatorId)) return false;
        ////
        $this->workDo->setCreatorId($creatorId);
        return $creator;
    }

    /**
     * @return bool|Creator
     * @throws Exception
     */
    public function getCreator(): bool|Creator {
        if (is_null($this->workDo->getCreatorId())) return false;
        return Store::creatorStore()->select($this->workDo->getCreatorId());
    }

    public function unsetCreator(): void {
        $this->workDo->setCreatorId(null);
    }

    /**
     * @return WorkDo
     */
    public function getWorkDo(): WorkDo {
        return $this->workDo;
    }
}