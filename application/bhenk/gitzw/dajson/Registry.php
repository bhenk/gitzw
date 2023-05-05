<?php

namespace bhenk\gitzw\dajson;

use function is_null;

class Registry {

    private static ?LoginRegistry $loginRegistry = null;
    private static ?UserRegistry $userRegistry = null;

    /**
     * @return LoginRegistry
     */
    public static function loginRegistry(): LoginRegistry {
        if (is_null(self::$loginRegistry)) {
            self::$loginRegistry = new LoginRegistry();
        }
        return self::$loginRegistry;
    }

    /**
     * @return UserRegistry
     */
    public static function userRegistry(): UserRegistry {
        if (is_null(self::$userRegistry)) {
            self::$userRegistry = new UserRegistry();
        }
        return self::$userRegistry;
    }

}