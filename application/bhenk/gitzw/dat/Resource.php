<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ResJoinRepDo;
use bhenk\gitzw\dao\ResourceDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\DimensionsTrait;
use bhenk\gitzw\model\MultiLanguageTitleTrait;
use bhenk\gitzw\model\ResourceCategories;
use Exception;
use ReflectionException;
use function is_null;
use function json_decode;
use function json_encode;

/**
 * A Resource in gitzwart is a work that can be represented by one or more images aka Representations
 *
 */
class Resource extends AbstractStoredObject {
    use MultiLanguageTitleTrait;
    use DimensionsTrait;
    use DateTrait;

    private ResourceRelations $relations;

    function __construct(private readonly ResourceDo $resourceDo = new ResourceDo(),
                         ?array                      $representationRelations = null) {
        $this->initTitleTrait($this->resourceDo);
        $this->initDimensionsTrait($this->resourceDo);
        $this->initDateTrait($this->resourceDo);
        $this->relations = new ResourceRelations($this->getID());
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
    public static function deserialize(string $serialized): Resource {
        $array = json_decode($serialized, true);
        $resourceArray = $array["resource"];
        $resourceDo = ResourceDo::fromArray($resourceArray["resourceDo"]);
        $rels = $resourceArray["relations"];
        $representationRelations = [];
        foreach ($rels as $relation) {
            $resJoinRepDo = ResJoinRepDo::fromArray($relation);
            $representationRelations[$resJoinRepDo->getFkRight()] = $resJoinRepDo;
        }
        return new Resource($resourceDo, $representationRelations);
    }

    /**
     * @throws Exception
     */
    public function serialize(): string {
        $array = ["resourceDo" => $this->resourceDo->toArray()];
        $rels = [];
        $array["relations"] = $rels;
        foreach ($this->relations->getRepresentationRelations() as $resJoinRepDo) {
            $resJoinRepDo->setFkLeft($this->getID());
            $rels[$resJoinRepDo->getFkRight()] = $resJoinRepDo->toArray();
        }
        return json_encode(["resource" => $array], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return ResourceRelations
     */
    public function getRelations(): ResourceRelations {
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
     * @return ResourceDo
     */
    public function getResourceDo(): ResourceDo {
        return $this->resourceDo;
    }
}