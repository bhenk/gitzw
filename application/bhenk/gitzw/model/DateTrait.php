<?php

namespace bhenk\gitzw\model;

use DateTimeImmutable;
use RuntimeException;
use function str_replace;
use function strlen;
use function strpos;
use function substr;

trait DateTrait {

    private DateInterface $date;

    public function initDateTrait(DateInterface $dateObject): void {
        $this->date = $dateObject;
    }

    /**
     * Get the creation date
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
        $date = self::rearrangeDate($date);
        if (!$date) return false;
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

    /**
     * Rearranges date
     *
     * Rearranges *d-m-Y* to *Y-m-d* and *m-Y* to *Y-m*.
     *
     * @param string $date
     * @return string|bool *Y-m-d*, *Y-m* or *Y*, returns *false* if illegible
     */
    public static function rearrangeDate(string $date): string|bool {
        $date = str_replace("/", "-", $date);
        if (strlen($date) == 4) {
            $dt = DateTimeImmutable::createFromFormat("Y", $date);
            if ($dt) return $date;
        }
        if (strlen($date) == 7) {
            $pos = strpos($date, "-");
            if ($pos == 4) {
                $dt = DateTimeImmutable::createFromFormat("Y-m", $date);
                if ($dt) return $date;
            }
            $m = substr($date, 0, 2);
            $y = substr($date, 3);
            $date_string = $y . "-" . $m;
            $dt = DateTimeImmutable::createFromFormat("Y-m", $date_string);
            if ($dt) return $date_string;
        }
        if (strlen($date) == 10) {
            $pos = strpos($date, "-");
            if ($pos == 4) {
                $dt = DateTimeImmutable::createFromFormat("Y-m-d", $date);
                if ($dt) return $date;
            }
            $d = substr($date, 0, 2);
            $m = substr($date, 3, 2);
            $y = substr($date, 6);
            $date_string = $y . "-" . $m . "-" . $d;
            $dt = DateTimeImmutable::createFromFormat("Y-m-d", $date_string);
            if ($dt) return $date_string;
        }
        return false;
    }

}