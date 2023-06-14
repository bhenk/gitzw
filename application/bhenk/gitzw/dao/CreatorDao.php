<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use function file_get_contents;
use function str_replace;

class CreatorDao extends AbstractDao {
    use GitDao;

    const TABLE_NAME = "tbl_creators";
    const TABLE_DEFINITION_FILE = __DIR__ . "/sql/tbl_creators.sql";

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
        return CreatorDo::class;
    }

    /**
     * @inheritDoc
     */
    public function getCreateTableStatement(): string {
        return str_replace("%tbl_name%", $this->getTableName(),
            file_get_contents(self::TABLE_DEFINITION_FILE));
    }

}