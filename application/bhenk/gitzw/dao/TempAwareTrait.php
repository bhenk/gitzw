<?php

namespace bhenk\gitzw\dao;

/**
 * A TempAware Dao can store its data objects in a temporary table
 */
trait TempAwareTrait {

    const TEMP_EXT = "_temp";

    private bool $temp = false;

    /**
     * @return bool
     */
    public function isTemp(): bool {
        return $this->temp;
    }

    /**
     * @param bool $temp
     */
    public function setTemp(bool $temp): void {
        $this->temp = $temp;
    }

    public function getTableNameExtension(): string {
        if ($this->temp) return self::TEMP_EXT;
        return "";
    }


}