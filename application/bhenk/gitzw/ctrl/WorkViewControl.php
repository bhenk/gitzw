<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\AAT;
use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Images;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\site\Request;
use EasyRdf\Graph;
use EasyRdf\Literal;
use EasyRdf\RdfNamespace;
use EasyRdf\Resource;
use Exception;
use function header;
use function json_encode;
use function ob_end_clean;
use function str_replace;
use function strlen;

class WorkViewControl extends WorkPageControl {

    private Work $work;
    private string $past_url;
    private string $future_url;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/work/view.css");
        $this->addStylesheet("/css/work/data.css");
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
            "url" => Env::getHttpsUrl() . "/" . $canonical,
            "mainEntity" => [ "@id" => $this->getWork()->getSDId()],
            "relatedLink" => [
                Env::getHttpsUrl() . "/"
                    . Store::workStore()->selectNearestUpByOrder($this->work->getOrder())->getCanonicalUrl(),
                Env::getHttpsUrl() . "/"
                    . Store::workStore()->selectNearestDownByOrder($this->work->getOrder())->getCanonicalUrl()
            ]
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
            $str = json_encode($this->getPageStructuredData(), JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
            $contentType = 'application/json';
            $ext = '.json';
        } else {
            $g = $this->createRdfGraph();
            if ($format == 'rdf') {
                $str = $g->serialise('rdf');
                $contentType = 'application/rdf+xml';
                $ext = '.rdf';
            } elseif ($format == 'n3') {
                $str = $g->serialise('n3');
                $contentType = 'text/n3';
                $ext = '.n3';
            } elseif ($format == 'turtle' or $format == 'ttl') {
                $str = $g->serialise('turtle');
                $contentType = 'text/turtle';
                $ext = '.ttl';
            } elseif ($format == 'ntriples' or $format == 'nt') {
                $str = $g->serialise('ntriples');
                $contentType = 'application/rdf-triples';
                $ext = '.nt';
            } else {
                throw new Exception('unknown format: '.$format);
            }
        }
        $filename = $request->getWork()->getRESID() . $ext;
        ob_end_clean();
        header("Content-type: ".$contentType);
        header("Content-disposition: attachment; filename = " . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' .strlen($str));
        echo $str;
    }

    private function createRdfGraph() : Graph {
        RdfNamespace::set('aat', AAT::URI_AAT);
        RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
        RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
        RdfNamespace::set('skos', 'http://www.w3.org/2004/02/skos/core#');
        RdfNamespace::set('gitz', 'http://gitzw.art/');
        RdfNamespace::set('schema', 'http://schema.org/');
        RdfNamespace::set('dct', 'http://purl.org/dc/terms/');
        RdfNamespace::set('qudt', 'http://qudt.org/schema/qudt/');
        RdfNamespace::set('unit', 'http://qudt.org/vocab/unit/');

        $g = new Graph();
        $res = $g->resource(Env::HTTP_URL . "/" . $this->work->getRESID(), 'rdf:Description');
        $res->addResource('rdf:type', new Resource('schema:VisualArtwork'));
        // AAT::ART_TYPES values
        foreach ($this->work->getTypeCodes() as $type) {
            $res->add('rdf:type', new Resource($type));
        }
        // https://gitzw.art/{crid-full-name}/work/drawing/2020/0000
        $res->add('schema:url', new Resource(Env::getHttpsUrl() . "/" . $this->work->getCanonicalUrl()));
        // http://gitzw.art/#hnq.2022._DSC0888.jpg
        $representation = $this->work->getRelations()->getPreferredRepresentation();
        $repId = Env::HTTP_URL . "/#" . str_replace("/", ".", $representation->getREPID());
        $repUrl = Env::getHttpsUrl() . $representation->getFileLocation(Images::IMG_30);

        $res->add('schema:image', new Resource($repId));

        if ($this->work->getTitleNl())
            $res->addLiteral('rdfs:label', $this->work->getTitleNl(), 'nl');
        if ($this->work->getTitleEn())
            $res->addLiteral('rdfs:label', $this->work->getTitleEn(), 'en');

        if ($this->work->getWidth() > 0 and $this->work->getHeight() > 0) {
            $bn = $g->newBNode();
            $bn->add('rdf:value', Literal::create($this->work->getWidth(), null, 'xsd:decimal'));
            $bn->addResource('qudt:unit', new Resource('unit:CentiM'));
            $res->addResource('qudt:width', $bn);
            $bn = $g->newBNode();
            $bn->add('rdf:value', Literal::create($this->work->getHeight(), null, 'xsd:decimal'));
            $bn->addResource('qudt:unit', new Resource('unit:CentiM'));
            $res->addResource('qudt:height', $bn);
        }

        list($surface_codes, $media_codes) = $this->work->getSurfaceAndMediaCodes();
        foreach ($media_codes as $medium) {
            $res->add('schema:artMedium', new Resource($medium));
        }
        foreach ($surface_codes as $surface) {
            $res->add('schema:artworkSurface', new Resource($surface));
        }

        $dateCreated = $this->work->getDate();
        if (!empty($dateCreated))
            $res->add('dct:created', Literal::create($dateCreated, null, 'xsd:dateTime'));

        $res->add('dct:creator', new Resource($this->work->getCreator()->getCRID()));
        $res->add('schema:copyrightHolder', new Resource($this->work->getCreator()->getCRID()));
        $res->add('schema:license', new Resource('https://creativecommons.org/licenses/by-nc-nd/4.0/'));

        $img = $g->resource($repId, 'rdf:Description');
        $img->addResource('rdf:type', new Resource('schema:ImageObject'));
        $img->add('schema:url', new Resource($repUrl));
        $img->add('schema:copyrightHolder', new Resource($this->work->getCreator()->getCRID()));

        return $g;
    }

}