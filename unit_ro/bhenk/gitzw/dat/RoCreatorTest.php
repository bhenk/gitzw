<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\base\Images;
use bhenk\gitzw\model\WorkCategories;
use bhenk\logger\unit\LogAttribute;
use bhenk\TestCaseRo;
use function PHPUnit\Framework\assertEquals;
use function var_dump;

#[LogAttribute(false)]
class RoCreatorTest extends TestCaseRo {

    public function testGetImageData() {
        $creator = Store::creatorStore()->select(1);
        $result = $creator->getImageData(WorkCategories::draw, Images::IMG_04, 0, 5);
        //var_dump($result);
        assertEquals(5, count($result));
    }

}
