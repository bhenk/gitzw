<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;

class CreatorDao extends AbstractDao {

    /**
     * @inheritDoc
     */
    public function getTableName(): string {
        return "tbl_creators";
    }

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string {
        return CreatorDo::class;
    }
}