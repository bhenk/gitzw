<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use function file_get_contents;

class RidDao extends AbstractDao {

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string {
        return RidDo::class;
    }

    /**
     * @inheritDoc
     */
    public function getTableName(): string {
        return "tbl_rid";
    }

    public function getCreateTableStatement(): string
    {
        return file_get_contents(__DIR__ ."/sql/tbl_rid.sql");
    }
}