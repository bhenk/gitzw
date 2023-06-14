<?php

namespace bhenk\gitzw\dao;

use bhenk\msdata\abc\AbstractDao;
use Exception;

trait GitDao  {

    /**
     * Count rows with conditions
     * @param string $where
     * @return int
     * @throws Exception
     */
    public function countWhere(string $where): int {
        // SELECT COUNT(*) FROM `tbl_creators` WHERE
        $sql = "SELECT COUNT(*) FROM " . $this->getTableName() . " WHERE " . $where . ";";
        $result = $this->execute($sql);
        return $result[0]["COUNT(*)"];
    }

    public function analyze(): array {
        $sql = "ANALYZE NO_WRITE_TO_BINLOG TABLE " . $this->getTableName() . ";";
        return $this->execute($sql);
    }
}