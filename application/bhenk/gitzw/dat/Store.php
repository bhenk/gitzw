<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\Dao;
use bhenk\logger\log\Log;
use Exception;
use function dirname;
use function is_dir;
use function is_null;
use function mkdir;

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
     * Get the data store directory for (de)serialization
     *
     * @return string data store directory
     * @throws Exception if data store directory not found
     */
    public static function getDataStore(): string {
        for ($i = 1; $i < 20; $i++) {
            $dir = dirname(__DIR__, $i);
            $data_dir = $dir . DIRECTORY_SEPARATOR . self::DATA_DIR;
            if (is_dir($data_dir)) {
                $store_dir = $data_dir . DIRECTORY_SEPARATOR . self::STORE_DIR;
                if (!is_dir($store_dir)) {
                    mkdir($store_dir);
                }
                Log::debug("Data store directory found after " . $i . " iterations", [$store_dir]);
                return $store_dir;
            }
        }
        $msg = "Data store directory 'data/store' not found";
        Log::error($msg);
        throw new Exception($msg);
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