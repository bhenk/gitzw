<?php

namespace bhenk\gitzw\dao;

use function is_null;

final class Dao {

    private static ?RepresentationDao $representationDao = null;
    private static ?ResJoinRepDao $resJoinRepDao = null;
    private static ?ResourceDao $resourceDao = null;
    private static ?CreatorDao $creatorDao = null;

    /**
     * @return RepresentationDao
     */
    public static function representationDao(): RepresentationDao {
        if (is_null(self::$representationDao)) {
            self::$representationDao = new RepresentationDao();
        }
        return self::$representationDao;
    }

    /**
     * @return ResJoinRepDao
     */
    public static function resJoinRepDao(): ResJoinRepDao {
        if (is_null(self::$resJoinRepDao)) {
            self::$resJoinRepDao = new ResJoinRepDao();
        }
        return self::$resJoinRepDao;
    }

    /**
     * @return ResourceDao|null
     */
    public static function resourceDao(): ?ResourceDao {
        if (is_null(self::$resourceDao)) {
            self::$resourceDao = new ResourceDao();
        }
        return self::$resourceDao;
    }

    /**
     * @return CreatorDao
     */
    public static function creatorDao(): CreatorDao {
        if (is_null(self::$creatorDao)) {
            self::$creatorDao = new CreatorDao();
        }
        return self::$creatorDao;
    }

}