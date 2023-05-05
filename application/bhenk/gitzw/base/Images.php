<?php

namespace bhenk\gitzw\base;

use bhenk\logger\log\Log;
use function dirname;
use function is_dir;
use function is_file;
use function mkdir;
use function str_replace;

class Images {

    const SMALLER = [300, 200];
    const SMALL = [600, 400];
    const MEDIUM_SMALL = [800, 533];
    const MEDIUM = [1200, 800];
    const LARGE = [2400, 1600];

    public static function locationForREPID(string $REPID, array $dimensions): string {
        $width = $dimensions[0];
        $height = $dimensions[1];
        $dim = $width . "x$height";

        $img_file = Env::public_img() . "/resized/$dim/" . $REPID;
        $img_dir = dirname($img_file);
        if (!is_dir($img_dir)) {
            mkdir($img_dir, 0777, true);
        }
        if (!is_file($img_file)) {
            $src = Env::dataDir() . "/images/$REPID";
            ImagePlant::resize($src, $img_file, $width, $height);
        }
        return "/img/resized/$dim/" . $REPID;
    }

}