<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Security;
use bhenk\gitzw\ctrla\AdminPageControl;
use bhenk\gitzw\ctrla\RepresentationsPageControl;
use bhenk\gitzw\site\Menu;
use bhenk\gitzw\site\MenuItem;
use bhenk\logger\log\Log;
use function count;
use function is_null;

class AdminHandler {


    public function canHandle(array $path): bool {
        $first = $path[0] ?? "";
        if ($first != "admin") return false;

        $sessionUser = Security::get()->getSessionUser();
        if (is_null($sessionUser)) {
            Log::info("No sessionUser for page admin");
            return false;
        }

        if (count($path) == 1) {
            $ctrl = new AdminPageControl();
            if ($ctrl->canHandle($path)) {
                $ctrl->handleRequest($path, $sessionUser, $this->prepareMenu(""));
                $ctrl->renderPage();
                return true;
            }
        }

        $act = $path[1];
        $menu = $this->prepareMenu($act);
        switch ($act) {
            case "representations":
                (new RepresentationsPageControl())->handleRequest($path, $sessionUser, $menu);
                return true;
            case "foo":
                return true;
        }

        return false;
    }

    private function prepareMenu(string $act): Menu {
        $site_menu = new Menu();
        $site_menu
            ->addItem(new MenuItem("/", "Home"))
            ->addItem(new MenuItem("/admin",
                "Admin", $act == ""))
            ->addItem(new MenuItem("/admin/representations",
                "Representations", $act == "representations"));
        return $site_menu;
    }

}