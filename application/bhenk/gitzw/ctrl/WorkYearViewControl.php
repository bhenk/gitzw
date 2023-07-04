<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use function ceil;
use function intval;

class WorkYearViewControl extends WorkPageControl {

    private array $works;
    private int $total_works;
    private int $page;
    private int $total_pages;
    private string $url_next;
    private string $url_previous;
    private bool $next_enabled = true;
    private bool $previous_enabled = true;

    function __construct(Request $request) {
        if ($request->getUrlPart(5) == "swipe_right") {
            $this->redirectSwipe($request,1);
            return;
        } elseif ($request->getUrlPart(5) == "swipe_left") {
            $this->redirectSwipe($request, -1);
            return;
        }
        parent::__construct($request);
        $this->addStylesheet("/css/work/year.css");
        $this->setIncludeColumn3(false);
        $this->setIncludeFooter(false);
        $this->handleRequest();
    }

    public function handleRequest(): void {
        $request = $this->getRequest();
        $creator = $request->getCreator();
        $year = intval($request->getUrlPart(3));
        $this->setPageTitle($creator->getFullName()
            . " - " . $request->getWorkCategory()->value . " - " . $year);
        $offset = 0;
        $limit = 30;
        $cat_name = $request->getWorkCategory()->name;
        $id = $request->getCreator()->getID();
        $paged_request = false;
        if ($request->getUrlPart(4) == "view") {
            $offset = intval($request->getUrlPart(5));
            $paged_request = true;
        }

        $where = "creatorId = $id AND YEAR(date) = $year AND category = '$cat_name' AND hidden = 0 ORDER BY RESID DESC";
        $this->total_works = Store::workStore()->countWhere($where);
        $this->works = Store::workStore()->selectWhere($where, $offset, $limit);

        $next = $offset + $limit;
        if ($next >= $this->total_works) {
            $this->next_enabled = false;
            $next = $offset;
        }
        $previous = $offset - $limit;
        if ($previous < 0) {
            $this->previous_enabled = false;
            $previous = 0;
        }

        $this->page = intval($offset / $limit) + 1;
        $this->total_pages = intval(ceil($this->total_works / $limit));
        $url = "/" . $creator->getUriName() . "/work/" . $request->getWorkCategory()->value . "/$year";
        $this->url_next = $url . "/view/" . $next;
        $this->url_previous = $url . "/view/" . $previous;
        if (!$paged_request) $request->setUseCache(true);
        $this->renderPage();
    }

    public function getWorks(): array {
        return $this->works;
    }

    public function getTotalWorks(): int {
        return $this->total_works;
    }

    public function getPage(): int {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int {
        return $this->total_pages;
    }

    public function getUrlNext(): string {
        return $this->url_next;
    }

    public function getUrlPrevious(): string {
        return $this->url_previous;
    }

    public function isNextEnabled(): string {
        return $this->next_enabled ? "" : " disabled";
    }

    public function isPreviousEnabled(): string {
        return $this->previous_enabled ? "" : " disabled";
    }

    public function isDigitsEnabled(): string {
        return ($this->next_enabled || $this->previous_enabled) ? "" : " disabled";
    }

    public function renderColumn1(): void {
        parent::renderColumn1();
        require_once Env::templatesDir() . "/work/pager.php";
    }

    public function renderColumn2(): void {
        require_once Env::templatesDir() . "/work/year_view.php";
    }

    private function redirectSwipe(Request $request, int $direction): void {
        $creator = $request->getCreator();
        $shortCrid = $creator->getShortCRID();
        $uri_cat = $request->getWorkCategory()->name;
        $uri_year = $request->getUrlPart(3);
        $result = Store::workStore()->selectCatYear($shortCrid);
        $uri_parts = [];
        $uri_count = 0;
        $uri_index = -1;
        foreach ($result as $array) {
            $cat = $array["category"];
            $year = $array["year"];
            $uri_parts[$uri_count] = "$cat/$year";
            if ($uri_cat == $cat && $uri_year == $year) $uri_index = $uri_count;
            $uri_count++;
        }
        $uri_index = $uri_index + $direction;
        if ($uri_index < 0) $uri_index = $uri_count - 1;
        if ($uri_index >= count($uri_parts)) $uri_index = 0;
        $url = "/" . $creator->getUriName() . "/work/" . $uri_parts[$uri_index];
        Site::redirect($url);
    }

}