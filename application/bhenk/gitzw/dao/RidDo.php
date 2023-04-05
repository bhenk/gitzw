<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\Entity;

class RidDo extends Entity {

    function __construct(private readonly ?int $ID = null,
                         private ?string       $RID = null,
                         private ?string       $title_en = null,
                         private ?string       $title_nl = null,
                         private ?string       $preferred = null,
                         private ?string       $media = null,
                         private float         $width = -1,
                         private float         $height = -1,
                         private float         $depth = -1,
                         private ?string       $date = null,
                         private ?string $d_format = null,
                         private ?bool         $hidden = false,
                         private int           $ordinal = -1,
                         private ?string       $category = null
    ) {
        parent::__construct($this->ID);
    }

    /**
     * @return string|null
     */
    public function getRID(): ?string {
        return $this->RID;
    }

    /**
     * @param string|null $RID
     */
    public function setRID(?string $RID): void {
        $this->RID = $RID;
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
    public function getPreferred(): ?string {
        return $this->preferred;
    }

    /**
     * @param string|null $preferred
     */
    public function setPreferred(?string $preferred): void {
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
     * @return int
     */
    public function getWidth(): int {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getDepth(): int {
        return $this->depth;
    }

    /**
     * @param int $depth
     */
    public function setDepth(int $depth): void {
        $this->depth = $depth;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getDateFormat(): ?string
    {
        return $this->d_format;
    }

    /**
     * @param string|null $d_format
     */
    public function setDateFormat(?string $d_format): void
    {
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

}