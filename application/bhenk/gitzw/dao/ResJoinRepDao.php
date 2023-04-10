<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractJoinDao;

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

}