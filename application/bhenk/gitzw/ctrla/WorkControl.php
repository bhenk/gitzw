<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\AAT;
use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Creator;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\handle\NotFoundHandler;
use bhenk\gitzw\model\DateUtil;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use DateTimeImmutable;
use Exception;
use function array_merge;
use function basename;
use function floatval;
use function intval;
use function str_starts_with;
use function substr;

class WorkControl extends Page3cControl {

    const MODE_NEW = 0;
    const MODE_CREATE = 1;
    const MODE_EDIT = 2;
    private int $mode = self::MODE_NEW;
    private ?Representation $representation = null;
    private ?Work $work = null;
    private string $crid = "";
    private string $category = "";
    private string $date = "";
    private string $repid = "";
    private array $errors = [];
    private array $add_errors = [];

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/work.css");
    }

    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["action"] == "new") $this->doCheckNewWork();
            if ($_POST["action"] == "create") $this->doCreateNewWork();
            if ($_POST["action"] == "update") $this->doUpdateWork();
            if (str_starts_with($_POST["action"], "rep_rel_")) $this->doUpdateRelation();
            if ($_POST["action"] == "add_repid") $this->doAddRepresentation();
        } else {
            $act = $this->getRequest()->getUrlPart(2);
            if ($act == "new") $this->showNew();
            if ($act == "edit") $this->showEditWork();
        }
    }

    private function showNew(): void {
        $repid = substr($this->getRequest()->getCleanUrl(), 15);
        $repr = Store::representationStore()->selectByREPID($repid);
        if ($repr) {
            $this->representation = $repr;
        }
        $this->setPageTitle("New work");
        $this->mode = self::MODE_NEW;
    }

    private function doCheckNewWork(): void {
        $this->crid = $_POST["crid"] ?? "";
        $this->category = $_POST["category"];
        $this->date = $_POST["date"] ?? "";
        $this->repid = $_POST["repid"] ?? "";
        list($dt, $format) = DateUtil::validate($this->date);
        if (!$dt) {
            $this->errors[] = "Date '$this->date' is not a valid datetime";
        } else {
            /** @var DateTimeImmutable  $dt */
            $this->date = $dt->format($format);
        }
        $creator = Store::creatorStore()->selectByCRID($this->crid);
        if (!$creator) {
            // not likely to occur when post is from form
            $this->errors[] = "Unknown creator CRID: '" . $this->crid . "'";
        } else if (!str_starts_with($this->repid, $creator->getShortCRID())) {
            $this->errors[] = "Creator/Representation mismatch: REPID does not start with short CRID";
        }
        $repr = Store::representationStore()->selectByREPID($this->repid);
        if (!$repr) {
            $this->errors[] = "REPID '$this->repid' is not valid";
        } else {
            $this->representation = $repr;
        }
        $cat = WorkCategories::forName($this->category);
        //
        if (!empty($this->errors)) {
            $this->showNew();
        } else {
            $year = intval($dt->format("Y"));
            $owner = basename($this->crid);
            $RESID = Store::workStore()->nextRESID($year, $cat, $owner);
            $this->work = new Work();
            $this->work->setRESID($RESID);
            $this->work->setCreator($creator);
            $this->work->getRelations()->addRepresentation($repr);
            $this->work->setCategory($cat);
            $this->work->setDate($this->date);

            $this->setPageTitle("Create $RESID" );
            $this->mode = self::MODE_CREATE;
            Log::info("Create $RESID");
        }
    }

    private function doCreateNewWork(): void {
        $crid = $_POST["crid"] ?? "";
        $category = $_POST["category"];
        $date = $_POST["date"] ?? "";
        $repid = $_POST["repid"] ?? "";
        $resid = $_POST["resid"] ?? "";
        $creator = Store::creatorStore()->selectByCRID($crid);
        $repr = Store::representationStore()->selectByREPID($repid);
        $cat = WorkCategories::forName($category);

        $work = new Work();
        $work->setRESID($resid);
        $work->setCreator($creator);
        $work->setCategory($cat);
        $work->setDate($date);
        $work->getRelations()->addRepresentation($repr);
        Store::workStore()->persist($work);
        Site::redirect("/admin/work/edit/$resid");
    }

    private function showEditWork(): void {
        $resid = $this->getRequest()->getUrlPart(3);
        $this->work = Store::workStore()->selectByRESID($resid);
        if (!$this->work) {
            (new NotFoundHandler())->handleRequest($this->getRequest());
            return;
        }
        $this->setPageTitle("Edit $resid");
        $this->mode = self::MODE_EDIT;
    }

    private function doUpdateWork(): void {
        $resid = $_POST["resid"] ?? "";
        $work = Store::workStore()->selectByRESID($resid);
        if (!$work) {
            (new NotFoundHandler())->handleRequest($this->getRequest());
            return;
        }
        $this->setPageTitle("Edit $resid");
        $this->mode = self::MODE_EDIT;

        Log::info("Updating $resid");
        $date = $_POST["date"] ?? $work->getDate();
        list($dt, $format) = DateUtil::validate($date);
        if (!$dt) {
            $this->errors[] = "Date '$date' is not a valid datetime";
        } else {
            /** @var DateTimeImmutable  $dt */
            $year = substr($dt->format($format), 0, 4);
            if ($year != $work->getYear()) {
                $this->errors[] = "Year $year in date is not confirm year in RESID";
            } else {
                $work->setDate($dt->format($format));
            }
        }

        $work->setTitleNl($_POST["title_nl"] ?? "");
        $work->setTitleEn($_POST["title_en"] ?? "");
        $work->setPreferredLanguage($_POST["pref_lang"] ?? "");

        $types = [];
        for ($i = 0; $i < count(AAT::ART_TYPES); $i++) {
            $term = $_POST["type$i"] ?? false;
            if ($term) $types[] = $term;
        }
        $work->setTypes($types);

        $work->setMedia($_POST["media"] ?? "");
        $work->setDimExtra($_POST["dim_extra"] ?? "");

        $work->setWidth(floatval($_POST["width"] ?? "-1"));
        $work->setHeight(floatval($_POST["height"] ?? "-1"));
        $work->setDepth(floatval($_POST["depth"] ?? "-1"));

        $work->setOrdinal(intval($_POST["ordinal"] ?? "-1"));
        $work->setHidden(isset($_POST["hidden"]));
        $work->setLocation($_POST["location"] ?? "");
        $this->work = Store::workStore()->persist($work);
    }

    private function doUpdateRelation(): void {
        if (!$this->setWork()) return;
        Log::info("Updating relations of " . $this->work->getRESID());
        $action = $_POST["action"];
        $repr_id = intval(substr($action, 8));
        $submit = $_POST["submit"] ?? "";
        if ($submit == "Delete") {
            $this->doDeleteRelation($repr_id);
        } else if ($submit == "Save") {
            $this->doSaveRelation($repr_id);
        } else {
            $this->errors[] = "Unknown submit action: $submit";
        }
    }

    private function doSaveRelation(int $repr_id): void {
        $workHasRep = $this->work->getRelations()->getRepRelations()[$repr_id];
        $workHasRep->setOrdinal($_POST["ordinal_$repr_id"] ?? -1);
        $workHasRep->setPreferred(isset($_POST["preferred_$repr_id"]) ?? false);
        $workHasRep->setHidden(isset($_POST["hidden_$repr_id"]) ?? false);
        $workHasRep->setDescription($_POST["description_$repr_id"] ?? "");
        if ($workHasRep->isPreferred()) {
            foreach ($this->work->getRelations()->getRepRelations() as $relation) {
                if ($relation->getID() != $workHasRep->getID()) {
                    $relation->setPreferred(false);
                }
            }
        }
        $this->work = Store::workStore()->persist($this->work);
    }

    private function doDeleteRelation(int $repr_id): void {
        if ($this->work->getRelations()->removeRepresentation($repr_id)) {
            $this->work = Store::workStore()->persist($this->work);
        } else {
            $this->errors = array_merge($this->errors, $this->work->getRelations()->getMessages());
        }
    }

    private function doAddRepresentation(): void {
        if (!$this->setWork()) return;
        Log::info("Adding representation to " . $this->work->getRESID());
        $repid = $_POST["add_repid"] ?? "";
        $representation = Store::representationStore()->selectByREPID($repid);
        if ($representation) {
            if ($this->work->getRelations()->addRepresentation($representation)) {
                $this->work = Store::workStore()->persist($this->work);
            } else {
                $this->add_errors = array_merge($this->add_errors, $this->work->getRelations()->getMessages());
            }
        } else {
            $this->add_errors[] = "Representation with REPID '$repid' not found";
        }
    }

    private function setWork(): bool {
        $resid = $_POST["resid"] ?? "";
        $work = Store::workStore()->selectByRESID($resid);
        if (!$work) {
            (new NotFoundHandler())->handleRequest($this->getRequest());
            return false;
        }
        $this->work = $work;
        $this->setPageTitle("Edit $resid");
        $this->mode = self::MODE_EDIT;
        return true;
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_NEW => "/admin/work/new.php",
            self::MODE_CREATE => "/admin/work/create.php",
            self::MODE_EDIT => "/admin/work/edit.php"
        };
        require_once Env::templatesDir() . $template;
    }

    /**
     * @return string
     */
    public function getCrid(): string {
        return $this->crid;
    }

    /**
     * @return string
     */
    public function getCategory(): string {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getRepid(): string {
        return $this->repid;
    }

    /**
     * @return Representation|null
     */
    public function getRepresentation(): ?Representation {
        return $this->representation;
    }

    public function getWork(): ?Work {
        return $this->work;
    }

    /**
     * @return Creator[]
     * @throws Exception
     */
    public function getCreators(): array {
        return Store::creatorStore()->selectWhere("1=1");
    }

    /**
     * @return string[]
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getAddErrors(): array {
        return $this->add_errors;
    }



}