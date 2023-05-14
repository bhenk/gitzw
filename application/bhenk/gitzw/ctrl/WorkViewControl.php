<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\site\Request;
use function json_encode;

class WorkViewControl extends WorkPageControl {

    private Work $work;
    private string $past_url;
    private string $future_url;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/work/view.css");
        $this->work = $request->getWork();
        $this->handleRequest();

    }

    public function handleRequest(): void {
        $request = $this->getRequest();
        $creator = $request->getCreator();
        $work = $request->getWork();

        $this->setPageTitle($creator->getFullName() . " - "
        . $work->getTitles() . " - " . $work->getRESID());
        $this->setIncludeFooter(false);

        $this->past_url = Store::workStore()->selectNearestUp($work->getID())->getCanonicalUrl();
        $this->future_url = Store::workStore()->selectNearestDown($work->getID())->getCanonicalUrl();

        $this->setStructuredData($this->getPageStructuredData());
        $this->renderPage();

    }

    public function getWork(): Work {
        return $this->work;
    }

    /**
     * @return string
     */
    public function getPastUrl(): string {
        return "/" . $this->past_url;
    }

    /**
     * @return string
     */
    public function getFutureUrl(): string {
        return "/" . $this->future_url;
    }

    public function renderColumn2(): void {
        require_once Env::templatesDir() . "/work/view.php";
    }

    public function getPageStructuredData(): array {
        $canonical = $this->work->getCanonicalUrl();
        $page_sd = [
            "@type" => "WebPage",
            "@id" => Env::HTTP_URL . "/" . $canonical,
            "url" => Env::HTTPS_URL . "/" . $canonical,
            "mainEntity" => [ "@id" => $this->getWork()->getSDId() ]
        ];
        $image_sd = $this->work->getRelations()->getPreferredRepresentation()->getStructuredData();
        $image_sd["copyrightHolder"] = $this->work->getCreator()->getCRID();
        $image_sd["license"] = "https://creativecommons.org/licenses/by-nc-nd/4.0/";
        return [
            "@context" => ["http://schema.org",
                ["aat" => "http://vocab.getty.edu/aat/"]],
            "@graph" => [$this->work->getStructuredData(),
                $image_sd,
                $page_sd
            ]
        ];
    }

}