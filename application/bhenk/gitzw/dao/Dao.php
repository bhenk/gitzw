<?php

namespace bhenk\gitzw\dao;

use Exception;
use function array_map;
use function implode;
use function is_null;

final class Dao {

    private static ?RepresentationDao $representationDao = null;
    private static ?WorkHasRepDao $workHasRepDao = null;
    private static ?WorkDao $workDao = null;
    private static ?CreatorDao $creatorDao = null;
    private static ?ExhibitionDao $exhibitionDao = null;
    private static ?ExhHasRepDao $exhHasRepDao = null;

    /**
     * @return array<string, GitDao>
     */
    public static function getDaos(): array {
        return [
            "CreatorDao" => self::creatorDao(),
            "RepresentationDao" => self::representationDao(),
            "WorkDao" => self::workDao(),
            "WorkHasRepDao" => self::workHasRepDao(),
            "ExhibitionDao" => self::exhibitionDao(),
            "ExhHasRepDao" => self::exhHasRepDao()
        ];
    }

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
     * @return WorkDao
     */
    public static function workDao(): WorkDao {
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
     * @return ExhibitionDao
     */
    public static function exhibitionDao(): ExhibitionDao {
        if (is_null(self::$exhibitionDao)) {
            self::$exhibitionDao = new ExhibitionDao();
        }
        return self::$exhibitionDao;
    }

    /**
     * @return ExhHasRepDao
     */
    public static function exhHasRepDao(): ExhHasRepDao {
        if (is_null(self::$exhHasRepDao)) {
            self::$exhHasRepDao = new ExhHasRepDao();
        }
        return self::$exhHasRepDao;
    }

    /**
     * @return array<string, int>
     * @throws Exception
     */
    public static function countWhere(string $where = "1=1"): array {
        $counts = [];
        foreach (self::getDaos() as $name => $dao) {
            $counts[$name] = $dao->countWhere($where);
        }
        return $counts;
    }

    public static function analyzeTables(): array {
        return self::creatorDao()->execute(self::getAnalyzeTablesStatement());
    }

    public static function getAnalyzeTablesStatement(): string {
        $tbl_names = array_map(function ($x) {
            return $x->getTableName();
        }, self::getDaos());
        return "ANALYZE NO_WRITE_TO_BINLOG TABLE " . implode(", ", $tbl_names);
    }

}