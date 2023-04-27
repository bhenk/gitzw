<?php

namespace bhenk\gitzw\base;

use PHPUnit\Framework\TestCase;
use function is_dir;
use function PHPUnit\Framework\assertTrue;

class EnvTest extends TestCase {

    public function testGetDataDirectory() {
        $dir = Env::dataDir();
        assertTrue(is_dir($dir));
    }

    public function testTemplatesDir() {
        $dir = Env::templatesDir();
        assertTrue(is_dir($dir));
    }
}
