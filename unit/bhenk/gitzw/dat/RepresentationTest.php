<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\RepresentationDo;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertStringEndsWith;

class RepresentationTest extends TestCase {

    public function testGetFilename() {
        $representation = new Representation(new RepresentationDo(null, "hnq/1986/dev.jpg"));
        assertStringEndsWith("data/images/hnq/1986/dev.jpg", $representation->getFilename());
    }

    public function testGetExifData() {
        $representation = new Representation(new RepresentationDo(null, "hnq/2020/_DSC0127a.jpg"));
        //var_dump($representation->getExifData());
        $exif = $representation->getExifData();
        $model = $exif["IFD0"]["Model"];
        assertEquals("NIKON D5500", $model);
        $dateTime = $exif["IFD0"]["DateTime"];
        assertEquals("2021:04:26 11:53:27", $dateTime);
        $dateTimeOriginal = $exif["EXIF"]["DateTimeOriginal"];
        assertEquals("2021:04:23 10:33:59", $dateTimeOriginal);

        $representation = new Representation(new RepresentationDo(null, "hnq/1986/dev.jpg"));
        $exif = $representation->getExifData();
        $model = $exif["IFD0"]["Model"] ?? null;
        assertNull($model);
    }
}
