<?php

namespace bhenk\gitzw\base;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertSame;

class SecurityTest extends TestCase {

    public function testGet() {
        $security = Security::get();
        $user = $security->getUserByName("gendan");
        assertEquals("Gendan Vehnberk", $user->getFullName());
        $lastLogin = date('Y-m-d H:i:s');
        $user->setLastLogin($lastLogin);
        $security->persist();
        Security::reset();
        $security2 = Security::get();
        assertNotSame($security, $security2);
        $user = $security2->getUserByName("gendan");
        assertEquals($lastLogin, $user->getLastLogin());
        assertSame($security2, Security::get());
    }
}
