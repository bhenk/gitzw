<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use Exception;
use function header;
use function json_encode;
use function ob_end_clean;
use function strlen;

class WorkViewControl extends WorkPageControl {

    private Work $work;
    private string $past_url;
    private string $future_url;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/work/view.css");
        $this->addStylesheet("/css/work/data.css");
        //$this->setIncludeCopyright(false);
        $this->work = $request->getWork();
        $this->handleRequest();

    }

    public function handleRequest(): void {
        $request = $this->getRequest();
        $format = $request->getFormat();
        if ($format) {
            $this->sendSD($request);
            return;
        }
        $creator = $request->getCreator();
        $work = $request->getWork();

        $this->setPageTitle($creator->getFullName() . " - "
        . $work->getTitles() . " - " . $work->getRESID());
        $this->setIncludeFooter(false);

        $this->past_url = Store::workStore()->selectNearestUpByOrder($work->getOrder())->getCanonicalUrl();
        $this->future_url = Store::workStore()->selectNearestDownByOrder($work->getOrder())->getCanonicalUrl();

        $this->setStructuredData($this->getPageStructuredData());
        $request->setUseCache(true);
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

    public function renderColumn3(): void {
        require_once Env::templatesDir() . "/work/data.php";
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

    private function sendSD(Request $request): void {
        $format = $request->getFormat();
        if ($format == 'jsonld' or $format == 'json') {
            $str = json_encode($this->getPageStructuredData(), JSON_PRETTY_PRINT+JSON_UNESCAPED_SLASHES);
            Log::info(">>>>>>" . $str);
            $contentType = 'application/json';
            $ext = '.json';
            $filename = $request->getWork()->getRESID() . $ext;
            ob_end_clean();
            header("Content-type: ".$contentType);
            header("Content-disposition: attachment; filename = " . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Content-Length: ' .strlen($str));
            echo $str;
        } else {
            throw new Exception("not found: " . $request->getRawUrl());
        }
    }

}