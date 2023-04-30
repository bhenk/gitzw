<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\site\Menu;

abstract class PageControl {

    private string $pageTitle = "gitzw.art";
    private array $stylesheets = [];
    private array $scriptLinks = [];

    public abstract function canHandle(array|string $path): bool;

    public function renderPage(): void {

    }

    /**
     * @return string
     */
    public function getPageTitle(): string {
        return $this->pageTitle;
    }

    /**
     * @param string $pageTitle
     */
    public function setPageTitle(string $pageTitle): void {
        $this->pageTitle = $pageTitle;
    }

    /**
     * @return array
     */
    public function getStylesheets(): array {
        return $this->stylesheets;
    }

    public function addStylesheet(string $name): void {
        $this->stylesheets[] = $name;
    }

    /**
     * @return array
     */
    public function getScriptLinks(): array {
        return $this->scriptLinks;
    }

    public function addScriptLink(string $name): void {
        $this->scriptLinks[] = $name;
    }

}