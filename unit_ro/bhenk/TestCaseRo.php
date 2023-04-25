<?php

namespace bhenk;

use bhenk\logger\log\Log;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\logger\unit\LogAttribute;
use bhenk\msdata\connector\MysqlConnector;
use Exception;
use PHPUnit\Framework\TestCase;

#[LogAttribute(false)]
class TestCaseRo extends TestCase {
    use ConsoleLoggerTrait {
        setUp as public consoleSetUp;
        tearDown as public consoleTearDown;
    }

    /**
     * Set MysqlConnector configuration to production database
     * @return void
     * @throws Exception
     */
    public function setUp(): void {
        $configuration = [
            "hostname" => "127.0.0.1",      // required
            "username" => "user",           // required
            "password" => "user",           // required
            "database" => "gitzw",          // required
        ];
        MysqlConnector::get()->setConfiguration($configuration);

        $this->consoleSetUp();
        Log::debug("Database is " . $configuration["database"]);
    }

    /**
     * Reset
     * @return void
     * @throws Exception
     */
    public function tearDown(): void {
        $this->consoleTearDown();
    }

}