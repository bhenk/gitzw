<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use function in_array;
use function intval;
use function strlen;

class RepExplorerControl extends Page3cControl {

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/reps.css");
        $this->setPageTitle("Explore Representations");
    }
    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        require_once Env::templatesDir() . "/admin/reps/overview.php";
    }

    public function getCountByYear(): array {
        return Store::representationStore()->countByYear();
    }

    public function getCountBySource(): array {
        return Store::representationStore()->countBySource();
    }

    public function getSql(): string {
        return Store::representationStore()->getREPIDsByFilterSql(false, false, false, 11);
    }

    public static function getIntermediateSql(): string {
        list($source, $hidden, $carousel, $operator) = self::getSqlParameters();
        $sql = Store::representationStore()->getREPIDsByFilterSql($source, $hidden, $carousel, $operator) . "\n";
        Log::info($sql);
        return $sql;
    }

    private static function getSqlParameters(): array {
        $source = false;
        if ($_POST["src_on"] ?? false) {
            $src = $_POST["src"];
            if (!empty($src)) {
                $source = "";
                if (in_array("NULL", $src)) {
                    $source .= "ISNULL(r.source)";
                }
                foreach ($src as $value) {
                    if ($value != "NULL") {
                        $or = strlen($source) > 0 ? " OR " : "";
                        $source .= $or . "r.source='$value'";
                    }
                }
                $source = "(" . $source . ")";
            }
        }
        $hidden = false;
        if ($_POST["hdn_on"] ?? false) {
            $hidden = ($_POST["hidden"] ?? false) ? 1 : 0;
        }
        $carousel = false;
        if ($_POST["crl_on"] ?? false) {
            $carousel = ($_POST["carousel"] ?? false) ? 1 : 0;
        }
        $src_and_or = $_POST["src_and_or"] == "AND" ? 1 : 0;
        $hdn_and_or = $_POST["hdn_and_or"] == "AND" ? 1 : 0;
        $operator = intval($src_and_or . $hdn_and_or);
        return [$source, $hidden, $carousel, $operator];
    }
}