<?php

namespace bhenk\gitzw\dao;

use bhenk\logger\log\Log;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use PHPUnit\Framework\TestCase;
use ReflectionException;

#[LogAttribute(false)]
class CreatorDaoTest extends TestCase {
    use ConsoleLoggerTrait;

    /**
     * @throws ReflectionException
     */
    public function testGetCreateTableStatement() {
        $statement = Dao::creatorDao()->getCreateTableStatement();
        Log::debug("statement: ", [$statement]);
        self::assertStringContainsString(CreatorDao::TABLE_NAME, $statement);
    }

}
