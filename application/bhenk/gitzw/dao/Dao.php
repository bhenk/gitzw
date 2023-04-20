<?php

namespace bhenk\gitzw\dao;

use function is_null;

final class Dao {

    private static ?RepresentationDao $representationDao = null;
    private static ?WorkHasRepDao $workHasRepDao = null;
    private static ?WorkDao $workDao = null;
    private static ?CreatorDao $creatorDao = null;
    private static ?ExhibitionDao $exhibitionDao = null;
    private static ?ExhHasWorkDao $exhHasWorkDao = null;

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
     * @return WorkHasRepDao
     */
    public static function workHasRepDao(): WorkHasRepDao {
        if (is_null(self::$workHasRepDao)) {
            self::$workHasRepDao = new WorkHasRepDao();
        }
        return self::$workHasRepDao;
    }

    /**
     * @return WorkDao|null
     */
    public static function workDao(): ?WorkDao {
        if (is_null(self::$workDao)) {
            self::$workDao = new WorkDao();
        }
        return self::$workDao;
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

    /**
     * @return ExhibitionDao|null
     */
    public static function exhibitionDao(): ?ExhibitionDao {
        if (is_null(self::$exhibitionDao)) {
            self::$exhibitionDao = new ExhibitionDao();
        }
        return self::$exhibitionDao;
    }

    /**
     * @return ExhHasWorkDao|null
     */
    public static function exhHasWorkDao(): ?ExhHasWorkDao {
        if (is_null(self::$exhHasWorkDao)) {
            self::$exhHasWorkDao = new ExhHasWorkDao();
        }
        return self::$exhHasWorkDao;
    }

}