<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\site\Menu;
use bhenk\gitzw\site\Request;

abstract class PageControl {

    private string $pageTitle = "gitzw.art";
    private array $stylesheets = [];
    private array $scriptLinks = [];
    private Request $request;

    /**
     * Construct class and prepare page
     * @param Request $request
     */
    function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Prepare page
     *
     * @return void
     */
    public abstract function handleRequest(): void;

    /**
     * Start emitting the page
     *
     * @return void
     */
    public abstract function renderPage(): void;

    /**
     * @return Request
     */
    public function getRequest(): Request {
        return $this->request;
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