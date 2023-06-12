<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Menu2d;
use bhenk\gitzw\site\MenuItem;
use bhenk\gitzw\site\Request;

abstract class WorkPageControl extends Page3cControl {

    private Menu2d $menu;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->menu = new Menu2d();
        $this->addStylesheet("/css/work/menu.css");
        $this->createMenu();
        $this->setIncludeHeader(false);
    }

    public function renderColumn1(): void {
        require_once Env::templatesDir() ."/base/logo.php";
        require_once Env::templatesDir() ."/work/menu.php";
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
        if ($this->getRequest()->hasSessionUser() && !Env::useCache()) {
            $work = $this->getRequest()->getWork();
            $menu_label = $this->menu->addMenuLabel("admin", "menu_label_admin");
            $menu_label->addItem(new MenuItem("/admin", "admin", false));
            if ($work) {
                $menu_label->addItem(new MenuItem("/admin/work/edit/"
                    . $work->getRESID(), "edit", false));
            }
            $menu_label->addItem(new MenuItem("/logout", "logout", false));
        }
    }

}