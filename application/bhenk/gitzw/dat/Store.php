<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\model\WorkCategories;
use bhenk\logger\log\Log;
use Exception;
use function dirname;
use function end;
use function intval;
use function is_dir;
use function is_null;
use function mkdir;
use function str_pad;
use function strrpos;
use function substr;

/**
 * Persistence of business objects
 *
 * Besides facilitating access to specialized Stores, this Store is capable of persisting and recuperating
 * the entire business layer.
 */
class Store {

    /**
     * Name of the directory where we expect to store data
     */
    const DATA_DIR = "data";
    /**
     * Name of the directory dedicated to store data from this Store
     */
    const STORE_DIR = "store";

    private static ?RepresentationStore $representationStore = null;
    private static ?WorkStore $workStore = null;
    private static ?CreatorStore $creatorStore = null;
    private static ?ExhibitionStore $exhibitionStore = null;
    private static ?string $data_directory = null;

    /**
     * Get the store for Creators
     *
     * @return CreatorStore store for Creators
     */
    public static function creatorStore(): CreatorStore {
        if (is_null(self::$creatorStore)) {
            self::$creatorStore = new CreatorStore();
        }
        return self::$creatorStore;
    }

    /**
     * Get the store for Representations
     *
     * @return RepresentationStore store for Representations
     */
    public static function representationStore(): RepresentationStore {
        if (is_null(self::$representationStore)) {
            self::$representationStore = new RepresentationStore();
        }
        return self::$representationStore;
    }

    /**
     * Get the store for Works
     *
     * @return WorkStore store for Works
     */
    public static function workStore(): WorkStore {
        if (is_null(self::$workStore)) {
            self::$workStore = new WorkStore();
        }
        return self::$workStore;
    }

    /**
     * @return ExhibitionStore|null
     */
    public static function exhibitionStore(): ?ExhibitionStore {
        if (is_null(self::$exhibitionStore)) {
            self::$exhibitionStore = new ExhibitionStore();
        }
        return self::$exhibitionStore;
    }

    /**
     * Get the next RESID for new Work
     * @param int|string|Creator $creator
     * @param WorkCategories $cat
     * @param int $year
     * @return bool|string
     * @throws Exception
     */
    public static function nextRESID(int|string|Creator $creator, WorkCategories $cat, int $year): bool|string {
        $creator = self::creatorStore()->get($creator);
        if (!$creator) return false;
        $resids = self::workStore()->selectRESIDsWhere($year, $cat, $creator->getShortCRID());
        $number = "0000";
        if (!empty($resids)) {
            $last = end($resids);
            $next_number = intval(substr($last, strrpos($last, ".") + 1)) + 1;
            $number = str_pad($next_number, 4, '0', STR_PAD_LEFT);
        }
        return $creator->getShortCRID() . ".work." . $cat->name . "." . $year . "." . $number;
    }

    /**
     * Get the next EXHID
     * @param int $year
     * @return string
     * @throws Exception
     */
    public static function nextEXHID(int $year): string {
        $exhids = self::exhibitionStore()->selectEXHIDsWhere($year);
        $number = "0000";
        if (!empty($exhids)) {
            $last = end($exhids);
            $next_number = intval(substr($last, strrpos($last, ".") + 1)) + 1;
            $number = str_pad($next_number, 4, '0', STR_PAD_LEFT);
        }
        return "gitzw.exh.$year.$number";
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function getDataDirectory(): string {
        if (is_null(self::$data_directory)) {
            for ($i = 1; $i < 20; $i++) {
                $dir = dirname(__DIR__, $i);
                $data_dir = $dir . DIRECTORY_SEPARATOR . self::DATA_DIR;
                if (is_dir($data_dir)) {
                    self::$data_directory = $data_dir;
                    return self::$data_directory;
                }
            }
            $msg = "Data directory 'data' not found";
            Log::error($msg);
            throw new Exception($msg);
        }
        return self::$data_directory;
    }

    /**
     * Get the data store directory for (de)serialization
     *
     * @return string data store directory
     * @throws Exception if data store directory not found
     */
    public static function getDataStore(): string {
        $store_dir = self::getDataDirectory() . DIRECTORY_SEPARATOR . self::STORE_DIR;
        if (!is_dir($store_dir)) {
            mkdir($store_dir);
        }
        return $store_dir;
    }

    /**
     * @return int[] counts of serialized business objects
     * @throws Exception
     */
    public static function serialize(): array {
        $counts = [];
        $datastore = self::getDataStore();
        $counts["creators"] = self::creatorStore()->serialize($datastore);
        $counts["representations"] = self::representationStore()->serialize($datastore);
        $countWorks = self::workStore()->serialize($datastore);
        $counts["works"] = $countWorks[0];
        $counts["work_relations"] = $countWorks[1];
        $countExhibitions = self::exhibitionStore()->serialize($datastore);
        $counts["exhibitions"] = $countExhibitions[0];
        $counts["exhibition_relations"] = $countExhibitions[1];
        return $counts;
    }

    /**
     * @return int[] counts of deserialized business objects
     * @throws Exception
     */
    public static function deserialize(): array {
        Dao::exhHasRepDao()->dropTable();
        Dao::workHasRepDao()->dropTable();
        Dao::workDao()->dropTable();
        Dao::creatorDao()->dropTable();
        Dao::representationDao()->dropTable();
        Dao::exhibitionDao()->dropTable();

        Dao::exhibitionDao()->createTable();
        Dao::creatorDao()->createTable();
        Dao::representationDao()->createTable();
        Dao::workDao()->createTable();
        Dao::workHasRepDao()->createTable();
        Dao::exhHasRepDao()->createTable();

        $counts = [];
        $datastore = self::getDataStore();
        $counts["creators"] = self::creatorStore()->deserialize($datastore);
        $counts["representations"] = self::representationStore()->deserialize($datastore);
        $countWorks = self::workStore()->deserialize($datastore);
        $counts["works"] = $countWorks[0];
        $counts["work_relations"] = $countWorks[1];
        $countExhibitions = self::exhibitionStore()->deserialize($datastore);
        $counts["exhibitions"] = $countExhibitions[0];
        $counts["exhibition_relations"] = $countExhibitions[1];
        return $counts;
    }

}