<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Menu2d;
use bhenk\gitzw\site\MenuItem;
use bhenk\gitzw\site\Request;
use Exception;
use function file_get_contents;
use function is_null;

class WorkPageControl extends Page3cControl {

    const MODE_WORK = 1;
    const MODE_CAT = 2;
    const MODE_YEAR = 3;
    const MODE_ID = 4;

    private int $mode;
    private Menu2d $menu;

    function __construct(Request $request, int $mode) {
        parent::__construct($request);
        $this->mode = $mode;
        $this->menu = new Menu2d();
        $this->addStylesheet("/css/work/menu.css");
    }

    public function handleRequest(): void {
        $this->createMenu();
        $this->setPageTitle($this->getTitle());
        $this->setIncludeHeader(false);

    }

//    public function renderPage(): void {
//        parent::renderPage();
//    }

    public function renderColumn1(): void {
        require_once Env::templatesDir() ."/base/logo.php";
        require_once Env::templatesDir() ."/work/menu.php";
    }

    public function renderColumn2(): void {
        echo "<h1>WorkPageControl MODE " . $this->mode . "</h1>";
        echo file_get_contents(Env::templatesDir() ."/test/lorem.txt");
    }

    /**
     * @return Menu2d
     */
    public function getMenu(): Menu2d {
        return $this->menu;
    }

    private function createMenu(): void {
        $shortCrid = $this->getRequest()->getCreator()->getShortCRID();
        $uri_cat = ($this->getRequest()->hasWorkCategory()) ? $this->getRequest()->getWorkCategory()->name : "";
        $uri_year = $this->getRequest()->getUrlPart(3);
        $result = Store::workStore()->selectCatYear($shortCrid);
        $href = "/" . $this->getRequest()->getCreator()->getUriName() . "/work/";
        $href_ = null;
        $previous = "";
        $menu_label = null;
        foreach ($result as $item) {
            $cat = $item["category"];
            $year = $item["year"];
            if ($cat != $previous) {
                $previous = $cat;
                $category = WorkCategories::forName($cat);
                $href_ = $href . $category->value . "/";
                $menu_label = $this->menu->addMenuLabel($cat, "menu_label_" .$cat, $cat == $uri_cat);
            }
            $menu_label->addItem(new MenuItem($href_ . $year, $year, ($year == $uri_year && $cat == $uri_cat)));
        }
    }

    private function getTitle(): string {
        $work = $this->getRequest()->getWork();
        if ($work) {
            return $work->getTitles()
                . " - " . $work->getCreator()->getFullName()
                . " - " . $work->getRESID();
        }
        $year = $this->getRequest()->getUrlPart(3);
        $cat = $this->getRequest()->getUrlPart(2);
        if (!empty($year)) {
            $category = WorkCategories::get($cat)->value;
            return $this->getRequest()->getCreator()->getFullName()
                . " - " . $category . " - " . $year;
        }
        if (!empty($cat)) {
            $category = WorkCategories::get($cat)->value;
            return $this->getRequest()->getCreator()->getFullName()
                . " - " . $category;
        }
        return $this->getRequest()->getCreator()->getFullName() . " - work";
    }

}