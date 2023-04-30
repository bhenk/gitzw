<?php

namespace bhenk\gitzw\site;

class Menu {

    private array $items = [];

    public function addItem(MenuItem $item): Menu {
        $this->items[$item->getLabel()] = $item;
        return $this;
    }

    public function getItemByLabel(string $label): ?MenuItem {
        return $this->items[$label] ?? null;
    }

    /**
     * @return array
     */
    public function getItems(): array {
        return $this->items;
    }



}