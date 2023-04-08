<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ResourceDo;
use bhenk\gitzw\dao\ResRepDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\DimensionsTrait;
use bhenk\gitzw\model\MultiLanguageTitleTrait;
use DateTimeImmutable;
use function array_keys;
use function gettype;
use function in_array;
use function is_null;
use function str_replace;
use function strlen;

class Resource extends AbstractStoredObject {
    use MultiLanguageTitleTrait;
    use DimensionsTrait;
    use DateTrait;

    function __construct(private readonly ResourceDo $resourceDo = new ResourceDo(),
                         private array               $representations = [],
                         private array               $repRelations = []) {
        $this->initTitleTrait($this->resourceDo);
        $this->initDimensionsTrait($this->resourceDo);
        $this->initDateTrait($this->resourceDo);
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
     * @return string|null
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
     * @return Representation[]
     */
    public function getRepresentations(): array {
        return $this->representations;
    }

    /**
     * @return ResRepDo[]
     */
    public function getRepRelations(): array {
        return $this->repRelations;
    }

    public function addRepresentation(Representation $representation): bool {
        $RID = $representation->getID();
        if (is_null($RID)) {
            return false;
        }
        if (in_array($RID, array_keys($this->representations))) {
            return false;
        }
        $this->representations[$RID] = $representation;
        $repRel = new ResRepDo();
        $repRel->setResourceID($this->getID());
        $repRel->setRepresentationID($RID);
        $this->repRelations[$RID] = $repRel;
        return true;
    }

    /**
     * @return int|null
     */
    public function getID(): ?int {
        return $this->resourceDo->getID();
    }

    public function removeRepresentation(Representation|int|string $representation): bool {
        $RID = -1;
        if ($representation instanceof Representation) {
            if (!is_null($representation->getID())) {
                $RID = $representation->getID();
            }
        } elseif (gettype($representation) == "integer") {
            $RID = $representation;
        } elseif (gettype($representation) == "string") {
            /** @var Representation $repo */
            foreach ($this->representations as $repo) {
                if ($repo->getREPID() == $representation) {
                    $RID = $repo->getID();
                    break;
                }
            }
        }
        if (in_array($RID, array_keys($this->representations))) {
            unset($this->representations[$RID]);
            /** @var ResRepDo $repRel */
            $repRel = $this->repRelations[$RID];
            $repRel->setDeleted(true);
            return true;
        }
        return false;
    }
}