<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\model\ProgressListener;
use bhenk\gitzw\model\WorkCategories;
use Exception;
use function array_diff;
use function array_merge;
use function array_sum;
use function end;
use function intval;
use function is_dir;
use function is_null;
use function mkdir;
use function scandir;
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
     * Name of the directory dedicated to store data from this Store
     */
    const STORE_DIR = "store";

    private static ?RepresentationStore $representationStore = null;
    private static ?WorkStore $workStore = null;
    private static ?CreatorStore $creatorStore = null;
    private static ?ExhibitionStore $exhibitionStore = null;

    /**
     * Get all stores in array [serializationDirectory => Store]
     *
     * @return array<string, StoreInterface>
     */
    public static function getStores(): array {
        return [
            self::creatorStore()->getName() => self::creatorStore(),
            self::representationStore()->getName() => self::representationStore(),
            self::workStore()->getName() => self::workStore(),
            self::exhibitionStore()->getName() => self::exhibitionStore(),
        ];
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
     * Get the data store directory for (de)serialization
     *
     * @return string data store directory
     */
    public static function getDataStore(): string {
        $store_dir = Env::dataDir() . DIRECTORY_SEPARATOR . self::STORE_DIR;
        if (!is_dir($store_dir)) {
            mkdir($store_dir);
        }
        return $store_dir;
    }

    /**
     * @param ?ProgressListener $pl
     * @return array<string,int> counts of serialized business objects
     * @throws Exception
     */
    public static function serialize(?ProgressListener $pl = null): array {
        if (is_null($pl)) {
            $pl = new ProgressListener("store", array_sum(self::serializationStats()), 100);
        }
        $datastore = self::getDataStore();
        return array_merge(
            self::creatorStore()->serialize($datastore, $pl),
            self::representationStore()->serialize($datastore, $pl),
            self::workStore()->serialize($datastore, $pl),
            self::exhibitionStore()->serialize($datastore, $pl)
        );
    }

    /**
     * @param ?ProgressListener $pl
     * @return int[] counts of deserialized business objects
     * @throws Exception
     */
    public static function deserialize(?ProgressListener $pl = null): array {
        if (is_null($pl)) {
            $pl = new ProgressListener("store", array_sum(self::serializationStats()), 100);
        }
        $pl->updateMessage("Dropping tables");
        Dao::exhHasRepDao()->dropTable();
        Dao::workHasRepDao()->dropTable();
        Dao::workDao()->dropTable();
        Dao::creatorDao()->dropTable();
        Dao::representationDao()->dropTable();
        Dao::exhibitionDao()->dropTable();

        $pl->updateMessage("Creating tables");
        Dao::exhibitionDao()->createTable();
        Dao::creatorDao()->createTable();
        Dao::representationDao()->createTable();
        Dao::workDao()->createTable();
        Dao::workHasRepDao()->createTable();
        Dao::exhHasRepDao()->createTable();

        $datastore = self::getDataStore();
        return array_merge(
            self::creatorStore()->deserialize($datastore, $pl),
            self::representationStore()->deserialize($datastore, $pl),
            self::workStore()->deserialize($datastore, $pl),
            self::exhibitionStore()->deserialize($datastore, $pl)
        );
    }

    /**
     * Count the current number of serialization files per store
     *
     * @return array<string, int>
     */
    public static function serializationStats(): array {
        $stats = [];
        foreach (self::getStores() as $name => $store) {
            $dir = self::getDataStore() . DIRECTORY_SEPARATOR . $store->getName();
            $files = array_diff(scandir($dir), array('..', '.'));
            $stats[$name] = count($files);
        }
        return $stats;
    }

    /**
     * Count current number of objects per store
     *
     * @return array<string, int>
     */
    public static function storeStats(): array {
        $stats = [];
        foreach (self::getStores() as $name => $store) {
            $stats[$name] = $store->getObjectCount();
        }
        return $stats;
    }

}