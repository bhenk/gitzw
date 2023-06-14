<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractJoinDao;
use function file_get_contents;
use function str_replace;

class ExhHasRepDao extends AbstractJoinDao {
    use GitDao;

    const TABLE_NAME = "tbl_exh_rep";
    const TABLE_DEFINITION_FILE = __DIR__ . "/sql/tbl_exh_rep.sql";

    /**
     * @inheritDoc
     */
    public function getTableName(): string {
        return self::TABLE_NAME;
    }

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string {
        return ExhHasRepDo::class;
    }

    /**
     * @inheritDoc
     */
    public function getCreateTableStatement(): string {
        return str_replace("%tbl_name%", $this->getTableName(),
            file_get_contents(self::TABLE_DEFINITION_FILE));
    }
}