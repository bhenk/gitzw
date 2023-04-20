<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use function file_get_contents;
use function str_replace;

class ExhibitionDao extends AbstractDao {

    const TABLE_NAME = "tbl_exhibitions";
    const TABLE_DEFINITION_FILE = __DIR__ . "/sql/tbl_exhibitions.sql";

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
        return ExhibitionDo::class;
    }

    public function getCreateTableStatement(): string {
        return str_replace("%tbl_name%", $this->getTableName(),
            file_get_contents(self::TABLE_DEFINITION_FILE));
    }
}