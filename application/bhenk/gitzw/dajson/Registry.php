<?php

namespace bhenk\gitzw\dajson;

use function is_null;

class Registry {

    private static ?LoginRegistry $loginRegistry = null;
    private static ?UserRegistry $userRegistry = null;
    private static ?ActionRegistry $actionRegistry = null;
    private static ?SitemapRegistry $sitemapRegistry = null;

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

    public static function actionRegistry (): ActionRegistry {
        if (is_null(self::$actionRegistry)) {
            self::$actionRegistry = new ActionRegistry();
        }
        return self::$actionRegistry;
    }

    public static function sitemapRegistry(): SitemapRegistry {
        if (is_null(self::$sitemapRegistry)) {
            self::$sitemapRegistry = new SitemapRegistry();
        }
        return self::$sitemapRegistry;
    }

}