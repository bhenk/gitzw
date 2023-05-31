<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use Exception;
use function array_values;
use function file_get_contents;
use function str_repeat;
use function str_replace;

class RepresentationDao extends AbstractDao {

    const TABLE_NAME = "tbl_representations";
    const TABLE_DEFINITION_FILE = __DIR__ . "/sql/tbl_representations.sql";

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string {
        return RepresentationDo::class;
    }

    /**
     * @throws Exception
     */
    public function selectByREPID(string $REPID): ?RepresentationDo {
        $array = $this->selectWhere("REPID='" . $REPID . "'");
        if (!empty($array)) return array_values($array)[0];
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getTableName(): string {
        return self::TABLE_NAME;
    }

    /**
     * @inheritDoc
     */
    public function getCreateTableStatement(): string {
        return str_replace("%tbl_name%", $this->getTableName(),
            file_get_contents(self::TABLE_DEFINITION_FILE));
    }


}