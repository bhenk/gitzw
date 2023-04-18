<?php

namespace bhenk\gitzw\dat;

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

    /**
     * @return int[] counts of serialized business objects
     * @throws Exception
     */
    public static function serialize(): array {
        $counts = [];
        $datastore = self::getDataStore();
        $counts["creators"] = self::creatorStore()->serialize($datastore);
        $counts["representations"] = self::representationStore()->serialize($datastore);
        $countArray = self::workStore()->serialize($datastore);
        $counts["works"] = $countArray[0];
        $counts["work_relations"] = $countArray[1];
        return $counts;
    }

    /**
     * Get the data store directory for (de)serialization
     *
     * @return string data store directory
     * @throws Exception if data store directory not found
     */
    public static function getDataStore(): string {
        $dir = dirname(__DIR__);
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
     * @return int[] counts of deserialized business objects
     * @throws Exception
     */
    public static function deserialize(): array {
        $counts = [];
        $datastore = self::getDataStore();
        $counts["creators"] = self::creatorStore()->deserialize($datastore);
        $counts["representations"] = self::representationStore()->deserialize($datastore);
        $countArray = self::workStore()->deserialize($datastore);
        $counts["works"] = $countArray[0];
        $counts["work_relations"] = $countArray[1];
        return $counts;
    }


}