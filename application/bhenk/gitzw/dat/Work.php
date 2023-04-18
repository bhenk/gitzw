<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\WorkHasRepDo;
use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\DimensionsTrait;
use bhenk\gitzw\model\MultiLanguageTitleTrait;
use bhenk\gitzw\model\ResourceCategories;
use bhenk\gitzw\model\StoredObjectInterface;
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

    function __construct(private readonly WorkDo $resourceDo = new WorkDo(),
                         ?array                  $representationRelations = null) {
        $this->initTitleTrait($this->resourceDo);
        $this->initDimensionsTrait($this->resourceDo);
        $this->initDateTrait($this->resourceDo);
        $this->relations = new WorkRelations($this->getID(), $representationRelations);
    }

    /**
     * @return int|null
     */
    public function getID(): ?int {
        return $this->resourceDo->getID();
    }

    /**
     * @throws ReflectionException
     */
    public static function deserialize(string $serialized): Work {
        $array = json_decode($serialized, true);
        $resourceArray = $array["resource"];
        $resourceDo = WorkDo::fromArray($resourceArray["resourceDo"]);
        $rels = $resourceArray["relations"];
        $representationRelations = [];
        foreach ($rels as $relation) {
            $resJoinRepDo = WorkHasRepDo::fromArray($relation);
            $representationRelations[$resJoinRepDo->getFkRight()] = $resJoinRepDo;
        }
        return new Work($resourceDo, $representationRelations);
    }

    /**
     * @throws Exception
     */
    public function serialize(): string {
        $array = ["resourceDo" => $this->resourceDo->toArray()];
        $rels = [];
        foreach ($this->relations->getRepresentationRelations() as $resJoinRepDo) {
            $resJoinRepDo->setFkLeft($this->getID());
            $rels[$resJoinRepDo->getFkRight()] = $resJoinRepDo->toArray();
        }
        $array["relations"] = $rels;
        return json_encode(["resource" => $array], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return WorkRelations
     */
    public function getRelations(): WorkRelations {
        return $this->relations;
    }

    public function getRESID(): ?string {
        return $this->resourceDo->getRESID();
    }

    /**
     * @param string $RESID
     */
    public function setRESID(string $RESID): void {
        $this->resourceDo->setRESID($RESID);
    }

    /**
     * @return string|null
     */
    public function getMedia(): ?string {
        return $this->resourceDo->getMedia();
    }

    /**
     * @param string $media
     */
    public function setMedia(string $media): void {
        $this->resourceDo->setMedia($media);
    }

    /**
     * @return bool
     */
    public function isHidden(): bool {
        return $this->resourceDo->getHidden() ?? false;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void {
        $this->resourceDo->setHidden($hidden);
    }

    /**
     * @return int
     */
    public function getOrdinal(): int {
        return $this->resourceDo->getOrdinal();
    }

    /**
     * @param int $ordinal
     */
    public function setOrdinal(int $ordinal): void {
        $this->resourceDo->setOrdinal($ordinal);
    }

    /**
     * @return ResourceCategories|null
     */
    public function getCategory(): ?ResourceCategories {
        return ResourceCategories::forName($this->resourceDo->getCategory());
    }

    /**
     * @param string|ResourceCategories $category
     * @return bool
     */
    public function setCategory(string|ResourceCategories $category): bool {
        if ($category instanceof ResourceCategories) {
            $this->resourceDo->setCategory($category->name);
            return true;
        } else {
            $cat = ResourceCategories::forName($category) ?? ResourceCategories::forValue($category);
            if ($cat) {
                $this->resourceDo->setCategory($cat->name);
                return true;
            }
        }
        return false;
    }

    /**
     * @param int|string|Creator $creator
     * @return bool|Creator
     * @throws Exception
     */
    public function setCreator(int|string|Creator $creator): bool|Creator {
        $creator = Store::creatorStore()->get($creator);
        if (!$creator) return false;
        $creatorId = $creator->getID();
        if (is_null($creatorId)) return false;
        ////
        $this->resourceDo->setCreatorId($creatorId);
        return $creator;
    }

    /**
     * @return bool|Creator
     * @throws Exception
     */
    public function getCreator(): bool|Creator {
        if ($this->resourceDo->getCreatorId() < 1) return false;
        return Store::creatorStore()->select($this->resourceDo->getCreatorId());
    }

    public function unsetCreator(): void {
        $this->resourceDo->setCreatorId(-1);
    }

    /**
     * @return WorkDo
     */
    public function getResourceDo(): WorkDo {
        return $this->resourceDo;
    }
}