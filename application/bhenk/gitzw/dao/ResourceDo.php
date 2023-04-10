<?php

namespace bhenk\gitzw\dao;

use bhenk\gitzw\model\DateInterface;
use bhenk\gitzw\model\DimensionsInterface;
use bhenk\gitzw\model\MultiLanguageTitleInterface;
use bhenk\msdata\abc\Entity;

class ResourceDo extends Entity implements MultiLanguageTitleInterface, DimensionsInterface, DateInterface {

    function __construct(?int            $ID = null,
                         private ?string $RESID = null,
                         private ?string $title_en = null,
                         private ?string $title_nl = null,
                         private ?string $preferred = null,
                         private ?string $media = null,
                         private float   $width = -1,
                         private float   $height = -1,
                         private float   $depth = -1,
                         private ?string $date = null,
                         private ?string $d_format = null,
                         private ?bool   $hidden = false,
                         private int     $ordinal = -1,
                         private ?string $category = null,
                         private int     $creatorId = -1
    ) {
        parent::__construct($ID);
    }

    /**
     * @return string|null
     */
    public function getRESID(): ?string {
        return $this->RESID;
    }

    /**
     * @param string|null $RESID
     */
    public function setRESID(?string $RESID): void {
        $this->RESID = $RESID;
    }

    /**
     * @return string|null
     */
    public function getTitleEn(): ?string {
        return $this->title_en;
    }

    /**
     * @param string|null $title_en
     */
    public function setTitleEn(?string $title_en): void {
        $this->title_en = $title_en;
    }

    /**
     * @return string|null
     */
    public function getTitleNl(): ?string {
        return $this->title_nl;
    }

    /**
     * @param string|null $title_nl
     */
    public function setTitleNl(?string $title_nl): void {
        $this->title_nl = $title_nl;
    }

    /**
     * @return string|null
     */
    public function getPreferredLanguage(): ?string {
        return $this->preferred;
    }

    /**
     * @param string|null $preferred
     */
    public function setPreferredLanguage(?string $preferred): void {
        $this->preferred = $preferred;
    }

    /**
     * @return string|null
     */
    public function getMedia(): ?string {
        return $this->media;
    }

    /**
     * @param string|null $media
     */
    public function setMedia(?string $media): void {
        $this->media = $media;
    }

    /**
     * @return float
     */
    public function getWidth(): float {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth(float $width): void {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getHeight(): float {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight(float $height): void {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getDepth(): float {
        return $this->depth;
    }

    /**
     * @param float $depth
     */
    public function setDepth(float $depth): void {
        $this->depth = $depth;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getDateFormat(): ?string {
        return $this->d_format;
    }

    /**
     * @param string|null $d_format
     */
    public function setDateFormat(?string $d_format): void {
        $this->d_format = $d_format;
    }

    /**
     * @return bool|null
     */
    public function getHidden(): ?bool {
        return $this->hidden;
    }

    /**
     * @param bool|null $hidden
     */
    public function setHidden(?bool $hidden): void {
        $this->hidden = $hidden;
    }

    /**
     * @return int
     */
    public function getOrdinal(): int {
        return $this->ordinal;
    }

    /**
     * @param int $ordinal
     */
    public function setOrdinal(int $ordinal): void {
        $this->ordinal = $ordinal;
    }

    /**
     * @return string|null
     */
    public function getCategory(): ?string {
        return $this->category;
    }

    /**
     * @param string|null $category
     */
    public function setCategory(?string $category): void {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getCreatorId(): int {
        return $this->creatorId;
    }

    /**
     * @param int $creatorId
     */
    public function setCreatorId(int $creatorId): void {
        $this->creatorId = $creatorId;
    }

}