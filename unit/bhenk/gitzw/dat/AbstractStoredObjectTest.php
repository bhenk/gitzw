<?php

namespace bhenk\gitzw\dat;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class AbstractStoredObjectTest extends TestCase {

    public function testDimensionsToString() {
        $result = AbstractStoredObject::dimensionsToString(2.54, 5.08, 10.16);
        $expected = "3 x 5 x 10 cm. [w x h x d] 1.0 x 2.0 x 4.0 in.";
        assertEquals($expected, $result);

        $result = AbstractStoredObject::dimensionsToString(2.54, 0, 10.16);
        $expected = "3 x 10 cm. [w x d] 1.0 x 4.0 in.";
        assertEquals($expected, $result);

        $result = AbstractStoredObject::dimensionsToString(0, 5.08, 10.16);
        $expected = "5 x 10 cm. [h x d] 2.0 x 4.0 in.";
        assertEquals($expected, $result);

        $result = AbstractStoredObject::dimensionsToString(2.54, 5.08, 0);
        $expected = "3 x 5 cm. [w x h] 1.0 x 2.0 in.";
        assertEquals($expected, $result);

        $result = AbstractStoredObject::dimensionsToString(2.54, 0, 0);
        $expected = "3 cm. [w] 1.0 in.";
        assertEquals($expected, $result);

        $result = AbstractStoredObject::dimensionsToString(0, 5.08, 0);
        $expected = "5 cm. [h] 2.0 in.";
        assertEquals($expected, $result);

        $result = AbstractStoredObject::dimensionsToString(0, 0, 10.16);
        $expected = "10 cm. [d] 4.0 in.";
        assertEquals($expected, $result);

        $result = AbstractStoredObject::dimensionsToString(0, 0, 0);
        $expected = "";
        assertEquals($expected, $result);
    }
}
