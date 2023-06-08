<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\site\Request;
use function count;
use function flush;
use function ob_end_clean;
use function ob_end_flush;
use function ob_get_contents;

class WorksControl extends \bhenk\gitzw\ctrl\Page3cControl {

    const MODE_UPDATE = 0;

    private int $mode = self::MODE_UPDATE;
    private int $count;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/works.css");
    }
    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
        $act = $this->getRequest()->getUrlPart(2);
        if ($act == "order") $this->updateWorkOrder();
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    private function updateWorkOrder(): void {
        $this->setPageTitle("Update order of works");
        $this->mode = self::MODE_UPDATE;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->doUpdateWorkOrder();
        }
    }

    private function doUpdateWorkOrder() {
        $where = "1 = 1 ORDER BY `category`, YEAR(`date`), `ordinal`";
        Store::workStore()->iterate(function ($count, $work) {
            /** @var Work $work */
            $work->setOrder($count);
            echo $work->getID() . " > $count * ";
            if (@ob_get_contents()) {
                @ob_end_flush();
            }
            flush();
        }, $where);
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_UPDATE => "/admin/works/update_order.php",
        };
        require_once Env::templatesDir() . $template;
    }
}