<?php

namespace bhenk\gitzw\model;

use bhenk\gitzw\dat\Work;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class DimensionsTraitTest extends TestCase {

    public function testDimensionsToString() {
        $resource = new Work();
        $resource->setDimensions(2.54, 5.08, 10.16);
        $result = $resource->getDimensions();
        $expected = "3 x 5 x 10 cm. [w x h x d] 1.0 x 2.0 x 4.0 in.";
        assertEquals($expected, $result);

        $resource->setDimensions(2.54, 0, 10.16);
        $result = $resource->getDimensions();
        $expected = "3 x 10 cm. [w x d] 1.0 x 4.0 in.";
        assertEquals($expected, $result);

        $resource->setDimensions(0, 5.08, 10.16);
        $result = $resource->getDimensions();
        $expected = "5 x 10 cm. [h x d] 2.0 x 4.0 in.";
        assertEquals($expected, $result);

        $resource->setDimensions(2.54, 5.08, 0);
        $result = $resource->getDimensions();
        $expected = "3 x 5 cm. [w x h] 1.0 x 2.0 in.";
        assertEquals($expected, $result);

        $resource->setDimensions(2.54, 0, 0);
        $result = $resource->getDimensions();
        $expected = "3 cm. [w] 1.0 in.";
        assertEquals($expected, $result);

        $resource->setDimensions(0, 5.08, 0);
        $result = $resource->getDimensions();
        $expected = "5 cm. [h] 2.0 in.";
        assertEquals($expected, $result);

        $resource->setDimensions(0, 0, 10.16);
        $result = $resource->getDimensions();
        $expected = "10 cm. [d] 4.0 in.";
        assertEquals($expected, $result);

        $resource->setDimensions(0, 0, 0);
        $result = $resource->getDimensions();
        $expected = "";
        assertEquals($expected, $result);
    }
}
