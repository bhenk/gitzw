<?php

namespace bhenk\gitzw\model;

use function number_format;

trait DimensionsTrait {

    const CM_TO_IN = 2.54;

    private DimensionsInterface $dims;

    public function initDimensionsTrait(DimensionsInterface $dimensions) {
        $this->dims = $dimensions;
    }

    public function setWidth(float $width): void {
        $this->dims->setWidth($width);
    }

    public function getWidth(): float {
        return $this->dims->getWidth();
    }

    public function setHeight(float $height): void {
        $this->dims->setHeight($height);
    }

    public function getHeight(): float {
        return $this->dims->getHeight();
    }

    public function setDepth(float $depth): void {
        $this->dims->setDepth($depth);
    }

    public function getDepth(): float {
        return $this->dims->getDepth();
    }

    public function setDimensions(float $w = -1.0, float $h = -1.0, float $d = -1.0): void {
        $this->dims->setWidth($w);
        $this->dims->setHeight($h);
        $this->dims->setDepth($d);
    }

    public function getDimensions(int $decCm = 0, int $decIn = 1): string {
        $w = $this->getWidth();
        $h = $this->getHeight();
        $d = $this->getDepth();
        // 150 x 160 cm. [w x h] 59.1 x 63.0 in.
        if ($w <= 0 and $h <= 0 and $d <= 0) return "";
        $cm = "";
        $dim = "[";
        $in = "";
        if ($w > 0) {
            $cm .= number_format($w, $decCm);
            $dim .= "w";
            $in .= number_format($w/self::CM_TO_IN, $decIn);
        }
        if ($w > 0 and $h > 0) {
            $cm .= " x ";
            $dim .= " x ";
            $in .= " x ";
        }
        if ($h > 0) {
            $cm .= number_format($h, $decCm);
            $dim .= "h";
            $in .= number_format($h/self::CM_TO_IN, $decIn);
        }
        if (($h > 0 and $d> 0) or ($h <= 0 and $d > 0 and $w > 0)) {
            $cm .= " x ";
            $dim .= " x ";
            $in .= " x ";
        }
        if ($d > 0) {
            $cm .= number_format($d, $decCm);
            $dim .= "d";
            $in .= number_format($d/self::CM_TO_IN, $decIn);
        }
        if ($w > 0 or $h > 0 or $d > 0) {
            $cm .= " cm. ";
            $in .= " in.";
        }
        $dim .= "] ";
        return $cm . $dim . $in;
    }

}