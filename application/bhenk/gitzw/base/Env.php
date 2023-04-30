<?php

namespace bhenk\gitzw\base;

use RuntimeException;
use function dirname;
use function is_dir;
use function is_null;

/**
 * Discover environment
 */
class Env {

    /**
     * Name of the directory where we expect this application
     */
    private const APPLICATION_DIR = "application";

    /**
     * Name of the directory where we expect data
     */
    private const DATA_DIR = "data";

    /**
     * Name of the directory where we expect templates
     */
    private const TEMPLATES_DIR = "templates";

    private static ?string $application_directory = null;
    private static ?string $data_directory = null;

    /**
     * Absolute path to directory where we expect this application
     * @return string
     */
    public static function applicationDir(): string {
        if (is_null(self::$application_directory)) {
            $dir = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . self::APPLICATION_DIR;
            if (is_dir($dir)) {
                self::$application_directory = $dir;
            } else {
                throw new RuntimeException("Application directory not found");
            }
        }
        return self::$application_directory;
    }

    /**
     * Absolute path to the directory where we expect data
     * @return string
     */
    public static function dataDir(): string {
        if (is_null(self::$data_directory)) {
            $dir = dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . self::DATA_DIR;
            if (is_dir($dir)) {
                self::$data_directory = $dir;
            } else {
                throw new RuntimeException("Data directory not found");
            }
        }
        return self::$data_directory;
    }

    /**
     * Absolute path to the directory where we expect templates
     * @return string
     */
    public static function templatesDir(): string {
        return self::applicationDir() . DIRECTORY_SEPARATOR . self::TEMPLATES_DIR;
    }

    public static function sessionExpirationMinutes(): int {
        return PHP_INT_MAX;
    }

}