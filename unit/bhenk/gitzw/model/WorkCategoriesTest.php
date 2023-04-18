<?php

namespace bhenk\gitzw\model;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class WorkCategoriesTest extends TestCase {

    public function testForName() {
        assertEquals(WorkCategories::draw, WorkCategories::forName("draw"));
    }

    public function testForValue() {
        assertEquals(WorkCategories::draw, WorkCategories::forValue("drawing"));
    }
}
