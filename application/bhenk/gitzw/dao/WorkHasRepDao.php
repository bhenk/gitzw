<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractJoinDao;

class WorkHasRepDao extends AbstractJoinDao {
    use TempAwareTrait;

    const TABLE_NAME = "tbl_work_repr";

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
        return WorkHasRepDo::class;
    }

}