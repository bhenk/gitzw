<?php

namespace bhenk\gitzw\model;

use DateTimeImmutable;
use function str_replace;
use function strlen;

trait DateTrait {

    private DateInterface $date;

    public function initDateTrait(DateInterface $dateObject): void {
        $this->date = $dateObject;
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
        if ($this->date->getDate()) {
            $format = $this->date->getDateFormat() ?? "Y";
            $dt = DateTimeImmutable::createFromFormat("Y-m-d", $this->date->getDate());
            return $dt->format($format);
        }
        return "";
    }

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
            $this->date->setDate($dt->format("Y-m-d"));
            $this->date->setDateFormat($format);
            return true;
        }
        return false;
    }

}