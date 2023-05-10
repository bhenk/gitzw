<?php

namespace bhenk\gitzw\model;

use function in_array;

trait MultiLanguageTitleTrait {

    const LANGUAGES = ["nl", "en"];

    private MultiLanguageTitleInterface $ml_title;

    public function initTitleTrait(MultiLanguageTitleInterface $ml_title): void {
        $this->ml_title = $ml_title;
    }

    /**
     * @param string $title_en
     */
    public function setTitleEn(string $title_en): void {
        $this->ml_title->setTitleEn($title_en);
    }

    /**
     * @param string $title_nl
     */
    public function setTitleNl(string $title_nl): void {
        $this->ml_title->setTitleNl($title_nl);
    }

    /**
     * @param string $preferred
     * @return bool
     */
    public function setPreferredLanguage(string $preferred): bool {
        if (in_array($preferred, self::LANGUAGES)) {
            $this->ml_title->setPreferredLanguage($preferred);
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
        return $this->ml_title->getPreferredLanguage() ?? "nl";
    }

    /**
     * @return string|null
     */
    public function getTitleEn(): ?string {
        return $this->ml_title->getTitleEn();
    }

    /**
     * @return string|null
     */
    public function getTitleNl(): ?string {
        return $this->ml_title->getTitleNl();
    }

    public function getTitles(string $ifempty = ""): string {
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
        }elseif ($second) {
            return $second;
        } else {
            return $ifempty;
        }
    }

}