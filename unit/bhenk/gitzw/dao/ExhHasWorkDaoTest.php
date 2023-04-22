<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\log\Log;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use PHPUnit\Framework\TestCase;
use ReflectionException;

#[LogAttribute(false)]
class ExhHasWorkDaoTest extends TestCase {
    use ConsoleLoggerTrait;

    /**
     * @throws ReflectionException
     */
    public function testGetCreateTableStatement() {
        $statement = Dao::exhHasRepDao()->getCreateTableStatement();
        Log::debug("statement: ", [$statement]);
        self::assertStringContainsString(ExhHasRepDao::TABLE_NAME, $statement);
    }

}
