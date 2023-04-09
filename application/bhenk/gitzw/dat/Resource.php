<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ResourceDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\DimensionsTrait;
use bhenk\gitzw\model\MultiLanguageTitleTrait;

class Resource extends AbstractStoredObject {
    use MultiLanguageTitleTrait;
    use DimensionsTrait;
    use DateTrait;

    private ResourceRelations $relations;

    function __construct(private readonly ResourceDo $resourceDo = new ResourceDo()) {
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
     * @return ResourceDo
     */
    public function getResourceDo(): ResourceDo {
        return $this->resourceDo;
    }

    /**
     * @return ResourceRelations
     */
    public function getRelations(): ResourceRelations {
        return $this->relations;
    }
}