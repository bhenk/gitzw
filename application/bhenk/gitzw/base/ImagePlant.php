<?php

namespace bhenk\gitzw\base;

use Imagick;
use ImagickException;
use function in_array;
use function intval;
use function is_dir;
use function is_file;
use function pathinfo;
use function scandir;
use function strtoupper;

/**
 * Manipulate images
 */
class ImagePlant {


    /**
     * Resize the image so that it fits the given dimensions
     * @param string $src
     * @param string $sink
     * @param int $max_width
     * @param int $max_height
     * @param bool $enlarge
     * @return void
     * @throws ImagickException
     */
    public static function resize(string $src,
                                  string $sink,
                                  int    $max_width,
                                  int    $max_height,
                                  bool   $enlarge = false): void {
        $imagick = new Imagick($src);
        $or_width = $imagick->getImageWidth();
        $or_height = $imagick->getImageHeight();
        $w_factor = $or_width/$max_width;
        $h_factor = $or_height/$max_height;
        $factor = max($w_factor, $h_factor);
        if ($factor < 1 and !$enlarge) {
            $width = $or_width;
            $height = $or_height;
        } else {
            $width = intval($or_width / $factor);
            $height = intval($or_height / $factor);
        }

        $imagick->resizeImage($width, $height, imagick::FILTER_SINC, 1);
        $imagick->writeImage($sink);
    }

    /**
     * Compare image files with SHA-256 message digest and return duplications
     *
     * Returns array: *[signature => [filename, filename, ..], ...]*.
     * @param string $base_dir
     * @return array<string, array>
     * @throws ImagickException
     */
    public static function compareSignatures(string $base_dir): array {
        $sig_array = [];
        $all_extensions = Imagick::queryFormats();
        return self::walkSignatures($base_dir, $sig_array, $all_extensions);
    }

    /**
     * @throws ImagickException
     */
    private static function walkSignatures(string $dir, array $sig_array, array $all_extensions): array {
        $files = array_diff(scandir($dir), array("..", ".", ".DS_Store"));
        foreach ($files as $file) {
            $filename = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_file($filename)) {
                $ext = strtoupper(pathinfo($filename, PATHINFO_EXTENSION));
                if (in_array($ext, $all_extensions)) {
                    $ix = new Imagick($filename);
                    $signature = $ix->getImageSignature();
                    if (!in_array($signature, array_keys($sig_array))) {
                        $sig_array[$signature] = [];
                    }
                    $sig_array[$signature][] = $filename;
                }
            } elseif (is_dir($filename)) {
                $sig_array = self::walkSignatures($filename, $sig_array, $all_extensions);
            }
        }
        return $sig_array;
    }

}