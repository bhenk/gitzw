<?php

namespace bhenk\gitzw\model;

interface MultiLanguageTitleInterface {

    public function getTitleEn(): ?string;

    public function setTitleEn(?string $title_en): void;

    public function getTitleNl(): ?string;

    public function setTitleNl(?string $title_nl): void;

    public function getPreferredLanguage(): ?string;

    public function setPreferredLanguage(?string $preferred): void;

}