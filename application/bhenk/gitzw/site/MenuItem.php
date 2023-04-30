<?php

namespace bhenk\gitzw\site;

class MenuItem extends AbstractElement {


    function __construct(private string $href, private string $label, private bool $active = false) {}

    /**
     * @return string
     */
    public function getHref(): string {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref(string $href): void {
        $this->href = $href;
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
     * @return bool
     */
    public function isActive(): bool {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void {
        $this->active = $active;
    }

    public function getClass(): string {
        if ($this->active) {
            return "active";
        } else {
            return "item";
        }
    }

}