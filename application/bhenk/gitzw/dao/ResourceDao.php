<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use function file_get_contents;

class ResourceDao extends AbstractDao
{

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string
    {
        return ResourceDo::class;
    }

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return "tbl_resources";
    }

    public function getCreateTableStatement(): string
    {
        return file_get_contents(__DIR__ . "/sql/tbl_resources.sql");
    }
}