<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use function file_get_contents;

class ResRepDao extends AbstractDao {

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string {
        return ResRepDo::class;
    }

    /**
     * @inheritDoc
     */
    public function getTableName(): string {
        return "tbl_res_rep";
    }

    /**
     * @inheritDoc
     */
    public function getCreateTableStatement(): string {
        return file_get_contents(__DIR__ . "/sql/tbl_res_rep.sql");
    }
}