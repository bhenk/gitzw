<?php

namespace bhenk\gitzw\store;

use function is_null;

class Store {

    private static ?RepresentationStore $representationStore = null;
    private static ?ResourceStore $resourceStore = null;

    /**
     * @return RepresentationStore|null
     */
    public static function representationStore(): ?RepresentationStore {
        if (is_null(self::$representationStore)) {
            self::$representationStore = new RepresentationStore();
        }
        return self::$representationStore;
    }

    /**
     * @return ResourceStore|null
     */
    public static function resourceStore(): ?ResourceStore {
        if (is_null(self::$resourceStore)) {
            self::$resourceStore = new ResourceStore();
        }
        return self::$resourceStore;
    }

}