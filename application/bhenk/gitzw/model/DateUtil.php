<?php

namespace bhenk\gitzw\model;

use DateTimeImmutable;

class DateUtil {


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
        $date = str_replace(":", "-", $date);
        $date = substr($date, 0, 10);
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

    /**
     * @param string $date
     * @return array<DateTimeImmutable|bool, string>
     */
    public static function validate(string $date): array {
        $date = self::rearrangeDate($date);
        if (!$date) return [false, ""];
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
        return [DateTimeImmutable::createFromFormat("Y-m-d", $date), $format];
    }
}