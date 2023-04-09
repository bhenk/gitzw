<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractJoinDao;
use Exception;
use function is_null;

class ResJoinRepDao extends AbstractJoinDao {

    /**
     * @inheritDoc
     */
    public function getTableName(): string {
        return "tbl_res_rep";
    }

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string {
        return ResJoinRepDo::class;
    }

    /**
     * @param int $resourceId
     * @param ResJoinRepDo[] $dos
     * @return ResJoinRepDo[]
     * @throws Exception
     */
    public function persist(int $resourceId, array $dos): array {
        $ingests = [];
        $deletes = [];
        $updates = [];
        foreach ($dos as $do) {
            $do->setFkLeft($resourceId);
            if (is_null($do->getID()) and !$do->isDeleted()) {
                $ingests[] = $do;
            } elseif ($do->isDeleted()) {
                $deletes[] = $do->getID();
            } else {
                $updates[$do->getFkRight()] = $do;
            }
        }
        if (!empty($deletes)) {
            Dao::resJoinRepDao()->deleteBatch($deletes);
        }
        if (!empty($updates)) {
            Dao::resJoinRepDao()->updateBatch($updates);
        }
        if (!empty($ingests)) {
            $inserted = Dao::resJoinRepDao()->insertBatch($ingests);
            /** @var ResJoinRepDo $insert */
            foreach ($inserted as $insert) {
                $updates[$insert->getFkRight()] = $insert;
            }
        }
        return $updates;
    }
}