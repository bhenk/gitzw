<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dajson\User;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Menu;
use bhenk\logger\log\Log;
use Exception;
use function count;
use function file_get_contents;
use function is_array;

class AdminPageControl extends Page3cControl {

    private Menu $site_menu;
    private ?User $sessionUser = null;

    public function canHandle(array|string $path): bool {
        if (is_array($path)) {
            if (count($path) > 1) return false;
            $first = $path[0] ?? "";
        } else {
            $first = $path;
        }
        if ($first != "admin") return false;
        return true;
    }

    public function handleRequest(array $path, User $sessionUser, Menu $site_menu): void {
        $this->sessionUser = $sessionUser;
        $this->site_menu = $site_menu;
    }

    public function renderPage(): void {
        Log::info("Rendering admin page for user " . $this->sessionUser->getName());
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
        require_once Env::templatesDir() . "/site/menu.php";
    }

    public function renderColumn2(): void {
        echo file_get_contents(Env::templatesDir() . "/test/lorem.txt");
    }

    public function renderColumn3(): void {
        echo "column 3";
    }
}