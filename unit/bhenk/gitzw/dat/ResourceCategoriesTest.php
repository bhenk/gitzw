<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\model\ResourceCategories;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class ResourceCategoriesTest extends TestCase {

    public function testForName() {
        assertEquals(ResourceCategories::draw, ResourceCategories::forName("draw"));
    }

    public function testForValue() {
        assertEquals(ResourceCategories::draw, ResourceCategories::forValue("drawing"));
    }
}
