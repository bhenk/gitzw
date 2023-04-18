<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;

class CreatorDao extends AbstractDao {
    use TempAwareTrait;

    const TABLE_NAME = "tbl_creators";

    /**
     * @inheritDoc
     */
    public function getTableName(): string {
        return self::TABLE_NAME . $this->getTableNameExtension();
    }

    /**
     * @inheritDoc
     */
    public function getDataObjectName(): string {
        return CreatorDo::class;
    }
}