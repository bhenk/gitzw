<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\daf\RepExplorerFilter;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use function array_fill_keys;
use function array_keys;
use function array_merge;
use function intval;
use function str_replace;

class RepExplorerControl extends Page3cControl {

    const MODE_EXPLORE = 0;
    const MODE_YEAR_VIEW = 1;

    private int $mode = self::MODE_EXPLORE;
    private RepExplorerFilter $repFilter;
    private array $countBySource = [];
    private array $countByYear = [];

    private array $representations = [];
    private string $cr_year;

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
        $this->cr_year = $this->getRequest()->getLastParts(3);
        if ($this->cr_year != "") {
            $this->handleYearView();
            return;
        }
        $readSourcePost = false;
        $readOrphanPost = false;
        $action = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $action = $_POST["action"] ?? false;
            $submit = $_POST["submit"] ?? false;
            if ($submit == "Execute" && $action == "source") {
                $readSourcePost = true;
            }
            if ($submit == "Execute" && $action == "orphan") {
                $readOrphanPost = true;
            }
        }
        $this->repFilter = new RepExplorerFilter($readSourcePost, $readOrphanPost);
        $this->countBySource = Store::representationStore()->countBySource();
        $this->countByYear = Store::representationStore()->countByYear();
        $_SESSION[self::class . ".filter"] = "";
        $_SESSION[self::class . ".where"] = "WHERE 1=1";
        if ($action == "source") $this->handleSourcePost();
        if ($action == "orphan") $this->handleOrphanPost();
    }

    private function handleSourcePost(): void {
        $_SESSION[self::class . ".filter"] = "source";
        $_SESSION[self::class . ".where"] = $this->repFilter->getSWhereClause();
        $neutral = array_fill_keys(array_keys($this->countBySource), 0);
        $rows = Dao::representationDao()->execute($this->repFilter->getSSourceCountSql());
        $filtered = [];
        foreach ($rows as $row) {
            $source = empty($row["source"]) ? "NULL" : $row["source"];
            $filtered[$source] = intval($row["count"]);
        }
        $this->countBySource = array_merge($neutral, $filtered);

        $neutral = array_fill_keys(array_keys($this->countByYear), 0);
        $rows = Dao::representationDao()->execute($this->repFilter->getSREPIDCountSql());
        $filtered = [];
        foreach ($rows as $row) {
            $filtered[$row["cr_year"]] = intval($row["count"]);
        }
        $this->countByYear = array_merge($neutral, $filtered);
    }

    private function handleOrphanPost(): void {
        $_SESSION[self::class . ".filter"] = "orphan";
        $_SESSION[self::class . ".where"] = $this->repFilter->getOWhereClause();
        $neutral = array_fill_keys(array_keys($this->countBySource), 0);
        $rows = Dao::representationDao()->execute($this->repFilter->getOSourceCountSql());
        $filtered = [];
        foreach ($rows as $row) {
            $source = empty($row["source"]) ? "NULL" : $row["source"];
            $filtered[$source] = intval($row["count"]);
        }
        $this->countBySource = array_merge($neutral, $filtered);

        $neutral = array_fill_keys(array_keys($this->countByYear), 0);
        $rows = Dao::representationDao()->execute($this->repFilter->getOREPIDCountSql());
        $filtered = [];
        foreach ($rows as $row) {
            $filtered[$row["cr_year"]] = intval($row["count"]);
        }
        $this->countByYear = array_merge($neutral, $filtered);
    }

    private function handleYearView(): void {
        $this->mode = self::MODE_YEAR_VIEW;
        $filter = $_SESSION[self::class . ".filter"] ?? "";
        if ($filter == "source") {
            $this->handleYearViewSource();
        } elseif ($filter == "orphan") {
            $this->handleYearViewOrphan();
        } else {
            $this->representations =
                Store::representationStore()->selectWhere("SUBSTR(REPID, 1, 8)='$this->cr_year'");
        }
    }

    private function handleYearViewSource(): void {
        $where = $_SESSION[self::class . ".where"] ?? "WHERE 1=1";
        $where .= " AND SUBSTR(r.REPID, 1, 8)='$this->cr_year'";
        $this->representations = Store::representationStore()->selectJoinWorkHasRepWhere($where);
    }

    private function handleYearViewOrphan(): void {
        $where = $_SESSION[self::class . ".where"] ?? "WHERE 1=1";
        if ($where == "") $where = "WHERE 1=1";
        $where .= " AND SUBSTR(REPID, 1, 8)='$this->cr_year'";
        $where = str_replace("WHERE ", "", $where);
        $this->representations = Store::representationStore()->selectWhere($where);
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_EXPLORE => "/admin/reps/overview.php",
            self::MODE_YEAR_VIEW => "/admin/reps/year_view.php"
        };
        require_once Env::templatesDir() . $template;
    }

    public function getCountByYear(): array {
        return $this->countByYear;
    }

    public function getCountBySource(): array {
        return $this->countBySource;
    }

    public function getFilter(): RepExplorerFilter {
        return $this->repFilter;
    }

    /**
     * @return Representation[]
     */
    public function getRepresentations(): array {
        return $this->representations;
    }

    /**
     * @return string
     */
    public function getCrYear(): string {
        return $this->cr_year;
    }

    public function getViewFilter(): string {
        $filter = $_SESSION[self::class . ".filter"] ?? "";
        if (empty($filter)) return "no filter";
        if ($filter == "source") return "sql filter";
        return "orphan filter";
    }
}