<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use function file_get_contents;

class RepresentationDao extends AbstractDao
{

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string
    {
        return RepresentationDo::class;
    }

    /**
     * @inheritDoc
     */
    public function getTableName(): string
    {
        return "tbl_representations";
    }

    /**
     * @inheritDoc
     */
    public function getCreateTableStatement(): string
    {
        return file_get_contents(__DIR__ . "/sql/tbl_representations.sql");
    }
}