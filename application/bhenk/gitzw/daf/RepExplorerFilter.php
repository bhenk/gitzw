<?php

namespace bhenk\gitzw\daf;

use bhenk\gitzw\dao\Dao;
use function in_array;
use function is_int;
use function is_string;
use function strlen;

class RepExplorerFilter {

    private bool $src_on = false;
    private bool $src_not = false;
    private bool $src_null_safe = false;
    private array $src = [];
    private bool $hdn_on = false;
    private int|bool $hidden = false;
    private bool $crl_on = false;
    private int|bool $carousel = false;
    private string|bool $source = false;
    private string $hdn_and_or = "AND";
    private string $crl_and_or = "AND";
    private string $s_where;
    private string $o_where;
    private bool $work_orphans = false;
    private bool $exh_orphans = false;

    function __construct(bool $readSourcePost = true, $readOrphanPost = true) {
        if ($readSourcePost) $this->readSourcePost();
        if ($readOrphanPost) $this->readOrphanPost();
        // s_where
        $op1 = ($this->hdn_and_or == "AND") ? "\nAND" : "\nOR";
        $op2 = ($this->crl_and_or == "AND") ? "\nAND" : "\nOR";
        $src = "";
        if (is_string($this->source)) $src = "$this->source";
        if (!empty($src)) $src .= (is_int($this->hidden) || is_int($this->carousel)) ? $op1 : "";
        $hdn = (is_int($this->hidden)) ? (" wr.hidden=$this->hidden" . ((is_int($this->carousel)) ? $op2 : "")) : "";
        $csl = (is_int($this->carousel)) ? " wr.carousel=$this->carousel" : "";
        $this->s_where = empty("$src$hdn$csl") ? "" : "\n" . "WHERE $src$hdn$csl";
        // o_where
        $w = "";
        if ($this->work_orphans) $w = "ID NOT IN (SELECT FK_RIGHT FROM " . Dao::workHasRepDao()->getTableName() . ")";
        $e = "";
        if ($this->exh_orphans) $e = "ID NOT IN (SELECT FK_RIGHT FROM " . Dao::exhHasRepDao()->getTableName() . ")";
        if ($this->work_orphans && $this->exh_orphans) $e = "\nAND $e";
        $this->o_where = empty("$w$e") ? "" : ("\n" . "WHERE $w$e");
    }

    public function getSWhereClause(): string {
        return $this->s_where;
    }

    public function getOWhereClause(): string {
        return $this->o_where;
    }

    public function getSSourceCountSql(): string {
        $tnr = Dao::representationDao()->getTableName();
        $tnwr = Dao::workHasRepDao()->getTableName();
        return "SELECT r.source, COUNT(DISTINCT r.ID) as count FROM $tnr r"
            .  "\n" . "INNER JOIN $tnwr wr ON r.ID = wr.FK_RIGHT"
            . "$this->s_where"
            . "\nGROUP BY r.source ORDER BY r.source;";
    }

    public function getSREPIDCountSql(): string {
        $tnr = Dao::representationDao()->getTableName();
        $tnwr = Dao::workHasRepDao()->getTableName();
        return "SELECT SUBSTR(r.REPID, 1, 8) as cr_year, COUNT(DISTINCT r.ID) as count FROM $tnr r"
            .  "\n" . "INNER JOIN $tnwr wr ON r.ID = wr.FK_RIGHT"
            . "$this->s_where"
            . "\nGROUP BY cr_year ORDER BY cr_year;";
    }

    public function getOSourceCountSql(): string {
        $tnr = Dao::representationDao()->getTableName();
        return "SELECT source, COUNT(*) as count FROM $tnr"
            . $this->o_where
            . "\nGROUP BY source ORDER BY source;";
    }

    public function getOREPIDCountSql(): string {
        $tnr = Dao::representationDao()->getTableName();
        return "SELECT SUBSTR(REPID, 1, 8) as cr_year, COUNT(*) as count FROM $tnr"
            . $this->o_where
            . "\nGROUP BY cr_year ORDER BY cr_year;";
    }


    /**
     * @return bool
     */
    public function isSrcOn(): bool {
        return $this->src_on;
    }

    /**
     * @return bool
     */
    public function isSrcNot(): bool {
        return $this->src_not;
    }

    /**
     * @return bool
     */
    public function isSrcNullSafe(): bool {
        return $this->src_null_safe;
    }

    /**
     * @return array
     */
    public function getSrc(): array {
        return $this->src;
    }

    /**
     * @return bool
     */
    public function isHdnOn(): bool {
        return $this->hdn_on;
    }

    /**
     * @return bool|int
     */
    public function getHidden(): bool|int {
        return $this->hidden;
    }

    /**
     * @return bool
     */
    public function isCrlOn(): bool {
        return $this->crl_on;
    }

    /**
     * @return bool|int
     */
    public function getCarousel(): bool|int {
        return $this->carousel;
    }

    /**
     * @return string
     */
    public function getHdnAndOr(): string {
        return $this->hdn_and_or;
    }

    /**
     * @return string
     */
    public function getCrlAndOr(): string {
        return $this->crl_and_or;
    }

    /**
     * @return bool
     */
    public function isWorkOrphans(): bool {
        return $this->work_orphans;
    }

    /**
     * @return bool
     */
    public function isExhOrphans(): bool {
        return $this->exh_orphans;
    }

    private function readSourcePost(): void {
        $this->src_on = $_POST["src_on"] ?? false;
        if ($this->src_on) {
            $this->src = $_POST["src"] ?? [];
            if (!empty($this->src)) {
                $this->source = "";
                if (in_array("NULL", $this->src)) {
                    $this->source .= "\tISNULL(r.source)";
                }
                $this->src_null_safe = $_POST["src_null_safe"] ?? false;
                $equals = ($this->src_null_safe) ? "<=>" : "=";
                foreach ($this->src as $value) {
                    if ($value != "NULL") {
                        $or = strlen($this->source) > 0 ? "\n\tOR " : "\t";
                        $this->source .= $or . "r.source$equals'$value'";
                    }
                }
                $this->source = "(\n" . $this->source . "\n)";
                $this->src_not = $_POST["src_not"] ?? false;
                if ($this->src_not) {
                    $this->source = "NOT " . $this->source;
                }
            }
        }
        $this->hdn_on = $_POST["hdn_on"] ?? false;
        if ($this->hdn_on) {
            $this->hidden = ($_POST["hidden"] ?? false) ? 1 : 0;
        }
        $this->crl_on = $_POST["crl_on"] ?? false;
        if ($this->crl_on) {
            $this->carousel = ($_POST["carousel"] ?? false) ? 1 : 0;
        }
        $this->hdn_and_or = ($_POST["hdn_and_or"] ?? "") == "OR" ? "OR" : "AND";
        $this->crl_and_or = ($_POST["crl_and_or"] ?? "") == "OR" ? "OR" : "AND";
    }

    private function readOrphanPost(): void {
        $this->work_orphans = (bool)(($_POST["work_orphans"] ?? false));
        $this->exh_orphans = (bool)(($_POST["exh_orphans"] ?? false));
    }
}