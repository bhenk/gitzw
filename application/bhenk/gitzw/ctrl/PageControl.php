<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\site\Request;
use function gettype;
use function json_encode;
use function str_contains;

abstract class PageControl {

    private string $pageTitle = "gitzw.art";
    private array $stylesheets = [];
    private array $scriptLinks = [];
    private array|string $structuredData = [];
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

    public function getReferrerUrl(): string|bool {
        if (isset($_SERVER["HTTP_REFERER"])) {
            return $_SERVER["HTTP_REFERER"];
        }
        return false;
    }

    public function getLocalReferrerUrl(): string|bool {
        $url = $this->getReferrerUrl();
        if ($url) {
            if (isset($_SERVER["HTTP_HOST"])) {
                if (str_contains($url, $_SERVER["HTTP_HOST"])) {
                    return $url;
                }
            }
        }
        return false;
    }

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

    public function setStructuredData(array|string $structuredData): void {
        $this->structuredData = $structuredData;
    }

    public function renderStructuredData(): void {
        if (!empty($this->structuredData)) {
            $sd = "\n".'<script type="application/ld+json">'."\n";
            if (gettype($this->structuredData) == "array") {
                $sd .= json_encode($this->structuredData, JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
            } else {
                $sd .= $this->structuredData;
            }
            $sd .= "\n".'</script>'."\n";
            $this->getRequest()->setStructuredData($sd);
        }
    }

}