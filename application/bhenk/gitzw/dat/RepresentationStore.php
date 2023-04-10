<?php

namespace bhenk\gitzw\dat;

use bhenk\doc2rst\log\Log;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\RepresentationDo;
use Exception;
use function array_values;
use function count;
use function gettype;
use function is_null;

/**
 * Store for obtaining and persisting Representations
 */
class RepresentationStore {

    /**
     * Persist the given Representation
     *
     * The {@link Representation} is inserted or updated.
     *
     * @param Representation $representation the Representation to persist
     * @return Representation the Representation after persistence (including Primary Id)
     * @throws Exception
     */
    public function persist(Representation $representation): Representation {
        if (is_null($representation->getID())) {
            return $this->insert($representation);
        } else {
            return $this->update($representation);
        }
    }

    /**
     * @throws Exception
     */
    private function insert(Representation $representation): Representation {
        /** @var RepresentationDo $representationDo */
        $representationDo = Dao::representationDao()->insert($representation->getRepresentationDo());
        return new Representation($representationDo);
    }

    /**
     * @throws Exception
     */
    private function update(Representation $representation): Representation {
        Dao::representationDao()->update($representation->getRepresentationDo());
        return $representation;
    }

    /**
     * Try and get the Representation
     *
     * @param int|string|Representation $representation Representation ID (int),
     *    Representation REPID (string)
     *    or Representation (object)
     * @return bool|Representation the Representation or *false* if Representation with ID not in store
     * @throws Exception
     */
    public function get(int|string|Representation $representation): bool|Representation {
        if ($representation instanceof Representation) return $representation;
        if (gettype($representation) == "integer") return $this->select($representation);
        if (gettype($representation) == "string") return $this->selectByREPID($representation);
        return false;
    }

    /**
     * Select the Representation with the given ID
     *
     * @param int $ID Representation ID
     * @return bool|Representation Representation or *false* if Representation with ID not in store
     * @throws Exception
     */
    public function select(int $ID): bool|Representation {
        /** @var RepresentationDo $do */
        $do = Dao::representationDao()->select($ID);
        if ($do) return new Representation($do);
        return false;
    }

    /**
     * Select the Representation with the alternative ID REPID
     *
     * @param string $REPID alternative Representation ID
     * @return bool|Representation Representation or *false* if Representation with REPID not in store
     * @throws Exception
     */
    public function selectByREPID(string $REPID): bool|Representation {
        $arr = Dao::representationDao()->selectWhere("REPID='" . $REPID . "'");
        if (count($arr) == 1) return new Representation(array_values($arr)[0]);
        if (count($arr) > 1) Log::warning("REPID not unique: " . $REPID);
        return false;
    }

    /**
     * Select Representations with given IDs
     *
     * @param int[] $IDs Representation IDs
     * @return Representation[] array of stored Representations
     * @throws Exception
     */
    public function selectBatch(array $IDs): array {
        $representations = [];
        $dos = Dao::representationDao()->selectBatch($IDs);
        /** @var RepresentationDo $do */
        foreach ($dos as $do) {
            $representations[$do->getID()] = new Representation($do);
        }
        return $representations;
    }

}