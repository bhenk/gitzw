<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\dao\Dao;
use bhenk\logger\log\Log;
use Exception;

class CreatorStore {

    /**
     * Persist the given Creator
     *
     * The {@link Creator} is inserted or updated
     *
     * @param Creator $creator the Creator to persist
     * @return Creator the Creator after persistence (includes Primary ID)
     * @throws Exception
     */
    public function persist(Creator $creator): Creator {
        if (is_null($creator->getID())) {
            return $this->ingest($creator);
        } else {
            return $this->update($creator);
        }
    }

    /**
     * @param Creator $creator
     * @return Creator
     * @throws Exception
     */
    private function ingest(Creator $creator): Creator {
        /** @var CreatorDo $do */
        $do = Dao::creatorDao()->insert($creator->getCreatorDo());
        return new Creator($do);
    }

    /**
     * @throws Exception
     */
    private function update(Creator $creator): Creator {
        Dao::creatorDao()->update($creator->getCreatorDo());
        return $creator;
    }

    /**
     * Try and get the Creator
     *
     * @param int|string|Creator $creator Creator ID (int),
     *    Creator CRID (string)
     *    or Creator (object)
     * @return bool|Creator the Creator or *false* if Creator with ID not in store
     * @throws Exception
     */
    public function get(int|string|Creator $creator): bool|Creator {
        if ($creator instanceof Creator) return $creator;
        if (gettype($creator) == "integer") return $this->select($creator);
        if (gettype($creator) == "string") return $this->selectByCRID($creator);
        return false;
    }

    /**
     * Select the Creator with the given ID
     *
     * @param int $ID Creator ID
     * @return bool|Creator Creator or *false* if Creator with ID not in store
     * @throws Exception
     */
    public function select(int $ID): bool|Creator {
        /** @var CreatorDo $do */
        $do = Dao::creatorDao()->select($ID);
        if ($do) return new Creator($do);
        return false;
    }

    /**
     * Select the Creator with the alternative ID CRID
     *
     * @param string $CRID alternative Creator ID
     * @return bool|Creator Creator or *false* if Creator with CRID not in store
     * @throws Exception
     */
    public function selectByCRID(string $CRID): bool|Creator {
        $arr = Dao::creatorDao()->selectWhere("CRID='" . $CRID . "'");
        if (count($arr) == 1) return new Creator(array_values($arr)[0]);
        if (count($arr) > 1) Log::warning("CRID not unique: " . $CRID);
        return false;
    }

    /**
     * Select Creators with given IDs
     *
     * @param int[] $IDs Creator IDs
     * @return Creator[] array of stored Creators
     * @throws Exception
     */
    public function selectBatch(array $IDs): array {
        $creators = [];
        $dos = Dao::creatorDao()->selectBatch($IDs);
        /** @var CreatorDo $do */
        foreach ($dos as $do) {
            $creators[$do->getID()] = new Creator($do);
        }
        return $creators;
    }


}