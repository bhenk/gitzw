<?php

namespace bhenk\gitzw\store;

use bhenk\doc2rst\log\Log;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dat\Representation;
use function array_values;
use function count;
use function gettype;
use function is_null;

class RepresentationStore {

    public function persist(Representation $representation): Representation {
        if (is_null($representation->getID())) {
            return $this->insert($representation);
        } else {
            return $this->update($representation);
        }
    }

    private function insert(Representation $representation): Representation {
        /** @var RepresentationDo $representationDo */
        $representationDo = Dao::representationDao()->insert($representation->getRepresentationDo());
        return new Representation($representationDo);
    }

    private function update(Representation $representation): Representation {
        Dao::representationDao()->update($representation->getRepresentationDo());
        return $representation;
    }

    public function get(int|string|Representation $representation): bool|Representation {
        if ($representation instanceof Representation) return $representation;
        if (gettype($representation) == "integer") return $this->select($representation);
        if (gettype($representation) == "string") return $this->selectByREPID($representation);
        return false;
    }

    public function select(int $ID): bool|Representation {
        /** @var RepresentationDo $do */
        $do = Dao::representationDao()->select($ID);
        if ($do) return new Representation($do);
        return false;
    }

    public function selectByREPID(string $REPID): bool|Representation {
        $arr = Dao::representationDao()->selectWhere("REPID='" . $REPID . "'");
        if (count($arr) == 1) return new Representation(array_values($arr)[0]);
        if (count($arr) > 1) Log::warning("REPID not unique: " . $REPID);
        return false;
    }

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