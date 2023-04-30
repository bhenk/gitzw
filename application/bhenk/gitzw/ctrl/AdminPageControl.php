<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Security;
use bhenk\gitzw\dajson\User;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Menu;
use bhenk\gitzw\site\MenuItem;
use bhenk\logger\log\Log;
use Exception;
use function file_get_contents;
use function is_array;
use function is_null;

class AdminPageControl extends Page3cControl {

    private Menu $site_menu;
    private ?User $sessionUser = null;

    public function canHandle(array|string $path): bool {
        if (is_array($path)) {
            $first = $path[0] ?? "";
        } else {
            $first = $path;
        }
        if ($first != "admin") return false;

        $this->sessionUser = Security::get()->getSessionUser();
        if (is_null($this->sessionUser)) {
            Log::info("No sessionUser for page admin");
            return false;
        }

        $this->prepareMenu();
        $this->renderPage();
        return true;
    }

    private function prepareMenu(): void {
        $this->site_menu = new Menu();
        $this->site_menu
            ->addItem(new MenuItem("/", "Home"))
            ->addItem(new MenuItem("#", "label a"))
            ->addItem(new MenuItem("#", "label b", true))
            ->addItem(new MenuItem("#", "label c"));
    }

    public function renderPage(): void {
        Log::info("Rendering admin page for " . $this->sessionUser->getName());
        $this->setPageTitle("Admin");
        $this->addStylesheet("/css/admin/header.css");
        $this->addStylesheet("/css/site/menu.css");
        $this->setIncludeFooter(false);
        parent::renderPage();
    }

    public function getSessionUserFullName(): string {
        return $this->sessionUser->getFullName();
    }

    public function getLastLogin(): string {
        return $this->sessionUser->getLastLogin();
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
        require_once Env::templatesDir() ."/site/menu.php";
    }

    public function renderColumn2(): void {
        echo file_get_contents(Env::templatesDir() . "/test/lorem.txt");
    }

    public function renderColumn3(): void {
        echo "column 3";
    }
}