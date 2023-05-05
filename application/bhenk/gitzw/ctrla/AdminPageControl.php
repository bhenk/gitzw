<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Menu;
use bhenk\gitzw\site\MenuItem;
use bhenk\gitzw\site\Request;
use Exception;
use function file_get_contents;

class AdminPageControl extends Page3cControl {

    private Menu $site_menu;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->site_menu = new Menu();
        $act = $this->getRequest()->getUrlPart(1);
        $this->site_menu
            ->addItem(new MenuItem("/", "Home"))
            ->addItem(new MenuItem("/admin", "Admin", $act == ""))
            ->addItem(new MenuItem("/admin/representations", "Representations",
                $act == "representations"));
    }

    public function handleRequest(): void {
        $this->setPageTitle("Admin");
        $this->setIncludeColumn3(false);
        $this->setIncludeFooter(false);
    }

    public function renderPage(): void {
        $this->addStylesheet("/css/admin/header.css");
        $this->addStylesheet("/css/site/menu.css");
        parent::renderPage();
    }

    public function getSessionUserFullName(): string {
        return $this->getRequest()->getSessionUser()->getFullName();
    }

    public function getLastLogin(): string {
        return $this->getRequest()->getSessionUser()->getLastLogin();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function countCategories(): string {
        $catCount = Store::workStore()->countByCategory();
        $s = "";
        $total = 0;
        foreach ($catCount as $cat => $count) {
            $s .= "$cat: $count &nbsp;";
            $total += $count;
        }
        return $s . "total: $total";
    }

    /**
     * @return Menu
     */
    public function getSiteMenu(): Menu {
        return $this->site_menu;
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() . "/admin/header.php";
    }

    public function renderColumn1(): void {
        require_once Env::templatesDir() . "/site/menu.php";
    }

    public function renderColumn2(): void {
        echo file_get_contents(Env::templatesDir() . "/test/lorem.txt");
    }

}