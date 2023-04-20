<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\log\Log;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use PHPUnit\Framework\TestCase;

#[LogAttribute(false)]
class WorkHasRepDaoTest extends TestCase {
    use ConsoleLoggerTrait;

    public function testGetCreateTableStatement() {
        $statement = Dao::workHasRepDao()->getCreateTableStatement();
        Log::debug("statement:", [$statement]);
        self::assertStringContainsString(WorkHasRepDao::TABLE_NAME, $statement);
    }
}
