<?php

namespace bhenk\gitzw\dajson;

use DateTime;
use PHPUnit\Framework\TestCase;
use function date;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class LoginTest extends TestCase {

    public function testGetLastLoginDate() {
        $login = new Login("42", []);
        assertFalse($login->getLastLoginDate());

        $date1 = date("2023-04-11 07:00:00");
        $login->addLoginAttempt($date1, true);
        assertEquals(new DateTime($date1), $login->getLastLoginDate());

        $date2 = date("2023-04-11 09:00:00");
        $login->addLoginAttempt($date2, true);
        assertEquals(new DateTime($date2), $login->getLastLoginDate());
    }

    public function testCanLoginWithSuccess() {
        $login = new Login("42", []);
        $date1 = date("2023-04-11 07:00:00");
        assertTrue($login->canLogin($date1));
        $login->addLoginAttempt($date1, true);

        $date2 = date("2023-04-11 09:00:00");
        assertTrue($login->canLogin($date2));
        $login->addLoginAttempt($date2, true);

        $date3 = date("2023-04-11 09:01:00");
        assertTrue($login->canLogin($date3));
        $login->addLoginAttempt($date3, true);

        $date4 = date("2023-04-11 09:02:00");
        assertTrue($login->canLogin($date4));
    }

    public function testCanLoginWithFailure() {
        $login = new Login("42", []);
        $date1 = date("2023-04-11 07:00:00");
        assertTrue($login->canLogin($date1));
        $login->addLoginAttempt($date1, false);

        $date2 = date("2023-04-11 09:00:00");
        assertTrue($login->canLogin($date2));
        $login->addLoginAttempt($date2, false);

        $date3 = date("2023-04-11 09:01:00");
        assertTrue($login->canLogin($date3));
        $login->addLoginAttempt($date3, false);

        $date4 = date("2023-04-11 09:02:00");
        assertFalse($login->canLogin($date4));

        $date5 = date("2023-04-11 12:02:00");
        assertTrue($login->canLogin($date5));
    }

}
