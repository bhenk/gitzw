<?php

namespace bhenk\gitzw\site;

class Menu {

    private array $items = [];

    function __construct(private string $label = "", private ?string $id = null) {}

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

    /**
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void {
        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void {
        $this->id = $id;
    }



}