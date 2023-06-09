<?php

namespace bhenk\gitzw\base;

use ImagickException;
use function dirname;
use function file_exists;
use function is_dir;
use function is_file;
use function mkdir;

class Images {

    const IMG_01 = [150, 150];
    const IMG_04 = [400, 400];
    const IMG_08 = [800, 800];
    const IMG_15 = [1500, 1500];
    const IMG_30 = [3000, 3000];

    /**
     * Returns the relative filepath to the image denoted by $REPID with the given dimensions.
     *
     * If the image does not exist, it will be created.
     * @param string $REPID
     * @param array $dimensions preferably one of the IMG_XX constants
     * @param bool $create
     * @return string relative filepath to the image
     * @throws ImagickException
     */
    public static function locationForREPID(string $REPID, array $dimensions, bool $create = true): string {
        $width = $dimensions[0];
        $height = $dimensions[1];
        $dim = $width . "x$height";

        $img_file = Env::public_img() . "/resized/$dim/" . $REPID;
        $img_dir = dirname($img_file);
        if (!is_dir($img_dir)) {
            mkdir($img_dir, 0777, true);
        }
        if (!is_file($img_file) && $create) {
            $src = Env::dataDir() . "/images/$REPID";
            ImagePlant::resize($src, $img_file, $width, $height);
        }
        return "/img/resized/$dim/" . $REPID;
    }

    /**
     * Create images for the given REPID in all sizes.
     * @param string $REPID
     * @return void
     * @throws ImagickException
     */
    public static function createImages(string $REPID): void {
        $sizes = self::getSizes();
        foreach ($sizes as $dimensions) {
            self::locationForREPID($REPID, $dimensions);
        }
    }

    /**
     * Get the sizes as defined in this class
     * @return int[][]
     */
    public static function getSizes(): array {
        return [self::IMG_01, self::IMG_04, self::IMG_08, self::IMG_15, self::IMG_30];
    }

    /**
     * Get existing absolute file locations for the given REPID for all sizes
     *
     * Returns absolute paths, in the format "{public_html}/img/resized/$dim/$REPID".
     * Will not create the images.
     *
     * @param string $REPID
     * @return string[]
     * @throws ImagickException
     */
    public static function getFileLocations(string $REPID): array {
        $locations = [];
        foreach (self::getSizes() as $size) {
            $location = self::locationForREPID($REPID, $size, false);
            $file = Env::public_html() . $location;
            if (file_exists($file)) {
                $locations[] = $file;
            }
        }
        return $locations;
    }

}