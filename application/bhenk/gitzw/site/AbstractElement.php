<?php

namespace bhenk\gitzw\site;

class AbstractElement {

    private bool $enabled = true;
    private bool $hidden = false;
    private bool $displayed = true;

    /**
     * @return bool
     */
    public function isEnabled(): bool {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void {
        $this->enabled = $enabled;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden(bool $hidden): void {
        $this->hidden = $hidden;
    }

    /**
     * @return bool
     */
    public function isDisplayed(): bool {
        return $this->displayed;
    }

    /**
     * @param bool $displayed
     */
    public function setDisplayed(bool $displayed): void {
        $this->displayed = $displayed;
    }

}