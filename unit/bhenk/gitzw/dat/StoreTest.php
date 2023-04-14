<?php

namespace bhenk\gitzw\dat;

use bhenk\logger\unit\ConsoleLoggerTrait;
use Exception;
use PHPUnit\Framework\TestCase;

class StoreTest extends TestCase {
    use ConsoleLoggerTrait;

    /**
     * @throws Exception
     */
    public function testGetDataStore() {
        $datastore = Store::getDataStore();
        self::assertDirectoryExists($datastore);
    }
}
