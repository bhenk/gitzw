<?php

namespace bhenk\gitzw\site;

class Menu2d {

    /** @var Menu[]  */
    private array $menu_labels = [];

    private ?string $active_menu_id = null;

    /**
     * @return Menu[]
     */
    public function getMenuLabels(): array {
        return $this->menu_labels;
    }

    /**
     * @param Menu[] $menu_labels
     */
    public function setMenuLabels(array $menu_labels): void {
        $this->menu_labels = $menu_labels;
    }

    public function addMenuLabel(string $label, ?string $id = null, bool $active = false): Menu {
        if ($active) $this->active_menu_id = $id;
        $menu = new Menu($label, $id);
        $this->menu_labels[] = $menu;
        return $menu;
    }

    public function getActiveMenuId(): ?string {
        return $this->active_menu_id;
    }

}