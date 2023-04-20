<?php

namespace bhenk\gitzw\dao;

use bhenk\gitzw\model\DateInterface;
use bhenk\gitzw\model\MultiLanguageTitleInterface;
use bhenk\msdata\abc\Entity;

class ExhibitionDo extends Entity implements DateInterface, MultiLanguageTitleInterface {

    function __construct(?int            $ID = null,
                         private ?string $EXHID = null,
                         private ?string $title_en = null,
                         private ?string $title_nl = null,
                         private ?string $preferred = null,
                         private ?string $subtitle = null,
                         private ?string $date = null,
                         private ?string $d_format = null,
                         private ?string $description = null,
    ) {
        parent::__construct($ID);
    }

    /**
     * @return string|null
     */
    public function getEXHID(): ?string {
        return $this->EXHID;
    }

    /**
     * @param string|null $EXHID
     */
    public function setEXHID(?string $EXHID): void {
        $this->EXHID = $EXHID;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getDate(): ?string {
        return $this->date;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }

    public function getDateFormat(): ?string {
        return $this->d_format;
    }

    public function setDateFormat(?string $d_format): void {
        $this->d_format = $d_format;
    }

    public function getTitleEn(): ?string {
        return $this->title_en;
    }

    public function setTitleEn(?string $title_en): void {
        $this->title_en = $title_en;
    }

    public function getTitleNl(): ?string {
        return $this->title_nl;
    }

    public function setTitleNl(?string $title_nl): void {
        $this->title_nl = $title_nl;
    }

    public function getPreferredLanguage(): ?string {
        return $this->preferred;
    }

    public function setPreferredLanguage(?string $preferred): void {
        $this->preferred = $preferred;
    }

    /**
     * @return string|null
     */
    public function getSubtitle(): ?string {
        return $this->subtitle;
    }

    /**
     * @param string|null $subtitle
     */
    public function setSubtitle(?string $subtitle): void {
        $this->subtitle = $subtitle;
    }
}