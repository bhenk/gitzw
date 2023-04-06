<?php

namespace bhenk\gitzw\dat;

use function count;
use function number_format;

abstract class AbstractStoredObject {

    const LANGUAGES = ["nl", "en"];

    public abstract function getID(): ?int;

    public static function dimensionsToString(float $w = -1, float $h = -1, float $d = -1): string {
        // 150 x 160 cm. [w x h] 59.1 x 63.0 in.
        if ($w <= 0 and $h <= 0 and $d <= 0) return "";
        $cm = "";
        $dim = "[";
        $in = "";
        if ($w > 0) {
            $cm .= number_format($w, 0);
            $dim .= "w";
            $in .= number_format($w/2.54, 1);
        }
        if ($w > 0 and $h > 0) {
            $cm .= " x ";
            $dim .= " x ";
            $in .= " x ";
        }
        if ($h > 0) {
            $cm .= number_format($h, 0);
            $dim .= "h";
            $in .= number_format($h/2.54, 1);
        }
        if (($h > 0 and $d> 0) or ($h <= 0 and $d > 0 and $w > 0)) {
            $cm .= " x ";
            $dim .= " x ";
            $in .= " x ";
        }
        if ($d > 0) {
            $cm .= number_format($d, 0);
            $dim .= "d";
            $in .= number_format($d/2.54, 1);
        }
        if ($w > 0 or $h > 0 or $d > 0) {
            $cm .= " cm. ";
            $in .= " in.";
        }
        $dim .= "] ";
        return $cm . $dim . $in;
    }


}