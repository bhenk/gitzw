<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\site\Menu;
use bhenk\gitzw\site\Request;
use function is_null;
use function json_encode;

abstract class PageControl {

    private string $pageTitle = "gitzw.art";
    private array $stylesheets = [];
    private array $scriptLinks = [];
    private array $structuredData = [];
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

    public function getStructuredData(): array {
        return $this->structuredData;
    }

    public function setStructuredData(array $structuredData): void {
        $this->structuredData = $structuredData;
    }

    public function renderStructuredData(): void {
        if (!empty($this->structuredData)) {
            $json = "\n".'<script type="application/ld+json">'."\n";
            $json .= json_encode($this->structuredData, JSON_PRETTY_PRINT+JSON_UNESCAPED_SLASHES);
            $json .= "\n".'</script>'."\n";
            $this->getRequest()->setStructuredData($json);
        }
    }

}