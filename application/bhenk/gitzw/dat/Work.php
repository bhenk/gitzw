<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\base\AAT;
use bhenk\gitzw\base\Env;
use bhenk\gitzw\dao\WorkDo;
use bhenk\gitzw\dao\WorkHasRepDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\DimensionsTrait;
use bhenk\gitzw\model\MultiLanguageTitleTrait;
use bhenk\gitzw\model\StoredObjectInterface;
use bhenk\gitzw\model\WorkCategories;
use Exception;
use ReflectionException;
use function explode;
use function implode;
use function in_array;
use function is_null;
use function json_decode;
use function json_encode;
use function strtolower;
use function trim;

/**
 * A Work in gitzwart is something that can be represented by one or more images aka Representations
 *
 */
class Work implements StoredObjectInterface {
    use MultiLanguageTitleTrait;
    use DimensionsTrait;
    use DateTrait;

    private WorkRelations $relations;
    private ?Creator $creator = null;

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

    public function getCanonicalUrl(Creator $creator = null): bool|string {
        if (is_null($this->getRESID())) return false;
        if (is_null($creator)) {
            $creator = $this->getCreator();
        }
        $resid_array = explode(".", $this->getRESID());
        $shortCRID = $resid_array[0];
        if ($shortCRID != $creator->getShortCRID()) return false;
        $this->creator = $creator;
        $cat = WorkCategories::forName($resid_array[2]);
        return $creator->getUriName() . "/work/$cat->value/$resid_array[3]/$resid_array[4]";
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
        if (is_null($this->creator)) {
            if (is_null($this->workDo->getCreatorId())) return false;
            $this->creator = Store::creatorStore()->select($this->workDo->getCreatorId());
        }
        return $this->creator;
    }

    public function unsetCreator(): void {
        $this->workDo->setCreatorId(null);
        $this->creator = null;
    }

    /**
     * @return array
     */
    public function getTypes(): array {
        if (is_null($this->workDo->getTypes())) {
            return [];
        }
        return explode(";", $this->workDo->getTypes());
    }

    /**
     * @param array $types
     */
    public function setTypes(array $types): void {
        if (empty($types)) {
            $this->workDo->setTypes(null);
        } else {
            $this->workDo->setTypes(implode(";", $types));
        }
    }

    /**
     * @return WorkDo
     */
    public function getWorkDo(): WorkDo {
        return $this->workDo;
    }

    public function getSDId(): string {
        return Env::HTTP_URL . "/" . $this->getRESID();
    }

    public function getStructuredData(): array {
        $additionalTypes = [];
        foreach ($this->getTypes() as $type) {
            $additionalTypes[] = $type;
            $additionalTypes[] = AAT::ART_TYPES[strtolower($type)];
        }
        $material = [];
        foreach (explode(" ", $this->getMedia()) as $word) {
            $term = strtolower(trim($word));
            $aat = AAT::ART_MEDIA[$term] ?? null;
            if ($aat) {
                $material[] = $term;
                $material[] = $aat;
            }
        }
        return [
            "@type" => "VisualArtwork",
            "@id"=> $this->getSDId(),
            "additionalType" => $additionalTypes,
            "url" => Env::HTTPS_URL . "/" . $this->getCanonicalUrl(),
            "name" => $this->getTitles("<no title>"),
            "image" => $this->getRelations()->getPreferredRepresentation()->getSDId(),
            "material" => $material,
            "width" => $this->getWidth().' cm',
            "height" => $this->getHeight().' cm',
            "dateCreated" => $this->getDate(),
            "creator" => $this->getCreator()->getStructuredDataShort(),
            "copyrightHolder" => $this->getCreator()->getCRID(),
            "license" => "https://creativecommons.org/licenses/by-nc-nd/4.0/"
        ];
    }
}