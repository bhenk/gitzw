<?php

namespace bhenk;

use bhenk\gitzw\dao\Dao;
use bhenk\logger\log\Log;
use bhenk\logger\unit\ConsoleLoggerTrait;
use bhenk\msdata\connector\MysqlConnector;
use Exception;
use PHPUnit\Framework\TestCase;

class TestCaseDb extends TestCase {
    use ConsoleLoggerTrait {
        setUp as public consoleSetUp;
        tearDown as public consoleTearDown;
    }

    private array $previous_configuration;

    /**
     * Set MysqlConnector configuration to test database, drop and create tables
     * @return void
     * @throws Exception
     */
    public function setUp(): void {
        $this->previous_configuration = MysqlConnector::get()->getConfiguration();
        $configuration = [
            "hostname" => "127.0.0.1",      // required
            "username" => "user",           // required
            "password" => "user",           // required
            "database" => "gitzw_test",     // required
            "use_parameterized_queries" => false
        ];
        MysqlConnector::get()->setConfiguration($configuration);

        Dao::exhHasRepDao()->dropTable();
        Dao::workHasRepDao()->dropTable();
        Dao::exhibitionDao()->dropTable();
        Dao::workDao()->dropTable();
        Dao::creatorDao()->dropTable();
        Dao::representationDao()->dropTable();

        Dao::creatorDao()->createTable();
        Dao::workDao()->createTable();
        Dao::exhibitionDao()->createTable();
        Dao::representationDao()->createTable();
        Dao::workHasRepDao()->createTable();
        Dao::exhHasRepDao()->createTable();

        $this->consoleSetUp();
        Log::debug("Database is " . $configuration["database"]);
    }

    /**
     * Reset MysqlConnector configuration to previous state
     * @return void
     * @throws Exception
     */
    public function tearDown(): void {
        Log::debug("Switching back to database " . $this->previous_configuration["database"]);
        $this->consoleTearDown();
        MysqlConnector::get()->setConfiguration($this->previous_configuration);
    }
}