<?php

namespace bhenk\gitzw\base;

use bhenk\logger\log\Log;
use ImagickException;
use function dirname;
use function is_dir;
use function is_file;
use function mkdir;
use function str_replace;

class Images {

    const IMG_01 = [150, 150];
    const IMG_04 = [400, 400];
    const IMG_06 = [600, 600];
    const IMG_08 = [800, 800];
    const IMG_15 = [1500, 1500];
    const IMG_30 = [3000, 3000];

    /**
     * Returns the relative filepath to the image denoted by $REPID with the given dimensions.
     *
     * If the image does not exist, it will be created.
     * @param string $REPID
     * @param array $dimensions preferably one of the IMG_XX constants
     * @return string relative filepath to the image
     * @throws ImagickException
     */
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