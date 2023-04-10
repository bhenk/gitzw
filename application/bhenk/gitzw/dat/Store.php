<?php

namespace bhenk\gitzw\dat;

use function is_null;

class Store {

    private static ?RepresentationStore $representationStore = null;
    private static ?ResourceStore $resourceStore = null;
    private static ?CreatorStore $creatorStore = null;

    /**
     * @return RepresentationStore
     */
    public static function representationStore(): RepresentationStore {
        if (is_null(self::$representationStore)) {
            self::$representationStore = new RepresentationStore();
        }
        return self::$representationStore;
    }

    /**
     * @return ResourceStore
     */
    public static function resourceStore(): ResourceStore {
        if (is_null(self::$resourceStore)) {
            self::$resourceStore = new ResourceStore();
        }
        return self::$resourceStore;
    }

    public static function creatorStore(): CreatorStore {
        if (is_null(self::$creatorStore)) {
            self::$creatorStore = new CreatorStore();
        }
        return self::$creatorStore;
    }

}