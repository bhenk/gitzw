<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\ResourceDo;
use DateTimeImmutable;
use function in_array;
use function str_replace;
use function strlen;

class Resource extends AbstractStoredObject {

    function __construct(private readonly ResourceDo $resourceDo = new ResourceDo()) {}

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
     * @param string $title_en
     */
    public function setTitleEn(string $title_en): void {
        $this->resourceDo->setTitleEn($title_en);
    }

    /**
     * @param string $title_nl
     */
    public function setTitleNl(string $title_nl): void {
        $this->resourceDo->setTitleNl($title_nl);
    }

    /**
     * @param string $preferred
     * @return bool
     */
    public function setPreferredLanguage(string $preferred): bool {
        if (in_array($preferred, self::LANGUAGES)) {
            $this->resourceDo->setPreferredLanguage($preferred);
            return true;
        }
        return false;
    }

    public function getPreferredTitle(): string {
        if ($this->getPreferredLanguage() == "en") {
            return $this->getTitleEn() ?? "";
        } else {
            return $this->getTitleNl() ?? "";
        }
    }

    /**
     * @return string
     */
    public function getPreferredLanguage(): string {
        return $this->resourceDo->getPreferredLanguage() ?? "nl";
    }

    /**
     * @return string|null
     */
    public function getTitleEn(): ?string {
        return $this->resourceDo->getTitleEn();
    }

    /**
     * @return string|null
     */
    public function getTitleNl(): ?string {
        return $this->resourceDo->getTitleNl();
    }

    public function getTitles(): string {
        if ($this->getPreferredLanguage() == "nl") {
            $first = $this->getTitleNl();
            $second = $this->getTitleEn();
        } else {
            $first = $this->getTitleEn();
            $second = $this->getTitleNl();
        }
        if ($first and $second) {
            return $first . " (" . $second . ")";
        } elseif ($first) {
            return $first;
        } else {
            return $second;
        }
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
     * @param int $width
     */
    public function setWidth(int $width): void {
        $this->resourceDo->setWidth($width);
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void {
        $this->resourceDo->setHeight($height);
    }

    /**
     * @param int $depth
     */
    public function setDepth(int $depth): void {
        $this->resourceDo->setDepth($depth);
    }

    public function getDimensions(): string {
        return self::dimensionsToString($this->getWidth(), $this->getHeight(), $this->getDepth());
    }

    /**
     * @return int
     */
    public function getWidth(): int {
        return $this->resourceDo->getWidth();
    }

    /**
     * @return int
     */
    public function getHeight(): int {
        return $this->resourceDo->getHeight();
    }

    /**
     * @return int
     */
    public function getDepth(): int {
        return $this->resourceDo->getDepth();
    }

    /**
     * Set creation date of the resource
     *
     * Allowed formats:
     * ```
     * yyyy-mm-dd
     * yyyy-mm
     * yyyy
     * ```
     *
     * @param string $date date in year-first format
     * @return bool *true* if date format was accepted, *false* otherwise
     */
    public function setDate(string $date): bool {
        $date = str_replace("/", "-", $date);
        $l = strlen($date);
        if ($l == 10) {
            $format = "Y-m-d";
        } elseif ($l == 7) {
            $format = "Y-m";
            $date = $date . "-01";
        } else {
            $format = "Y";
            $date = $date . "-01-01";
        }
        $dt = DateTimeImmutable::createFromFormat("Y-m-d", $date);
        if ($dt) {
            $this->resourceDo->setDate($dt->format("Y-m-d"));
            $this->resourceDo->setDateFormat($format);
            return true;
        }
        return false;
    }

    /**
     * Get the creation date of the resource
     *
     * Gets the creation date in the original format. If no creation date was set will return
     * the empty string.
     *
     * @return string date in original format or empty string
     */
    public function getDate(): string {
        if ($this->resourceDo->getDate()) {
            $format = $this->resourceDo->getDateFormat() ?? "Y";
            $dt = DateTimeImmutable::createFromFormat("Y-m-d", $this->resourceDo->getDate());
            return $dt->format($format);
        }
        return "";
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
}