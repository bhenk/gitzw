<?php

namespace bhenk\gitzw\store;

use bhenk\doc2rst\log\Log;
use bhenk\gitzw\dao\RepresentationDao;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\dat\Representation;
use function count;
use function is_null;

class RepresentationStore {

    private ?RepresentationDao $representationDao = null;

    public function storeRepresentation(Representation $representation): Representation {
        if (is_null($representation->getID())) {
            return $this->insert($representation);
        } else {
            return $this->update($representation);
        }
    }

    public function getRepresentationByID(int $ID): bool|Representation {
        /** @var RepresentationDo $do */
        $do = $this->getRepresentationDao()->select($ID);
        if ($do) return new Representation($do);
        return false;
    }

    public function getRepresentationByREPID(string $REPID): bool|Representation {
        $arr = $this->getRepresentationDao()->selectWhere("REPID='" . $REPID . "'");
        if (count($arr) == 1) return new Representation($arr[0]);
        if (count($arr) > 1) Log::warning("REPID not unique: " . $REPID);
        return false;
    }

    private function insert(Representation $representation): Representation {
        /** @var RepresentationDo $representationDo */
        $representationDo = $this->getRepresentationDao()->insert($representation->getRepresentationDo());
        return new Representation($representationDo);
    }

    private function update(Representation $representation): Representation {
        $this->getRepresentationDao()->update($representation->getRepresentationDo());
        return $representation;
    }

    /**
     * @return RepresentationDao
     */
    private function getRepresentationDao(): RepresentationDao {
        if (is_null($this->representationDao)) {
            $this->representationDao = new RepresentationDao();
        }
        return $this->representationDao;
    }

}