<?php

namespace bhenk\gitzw\base;

use EasyRdf\Graph;
use EasyRdf\Literal;
use EasyRdf\RdfNamespace;
use Exception;
use function array_keys;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function explode;
use function fclose;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function fopen;
use function is_null;
use function json_decode;
use function json_encode;
use function ksort;
use function str_contains;
use function str_replace;
use function strtolower;
use function usort;

class AAT {

    const URI_AAT = "http://vocab.getty.edu/aat/";
    const URI_AAT_PAGE = "http://vocab.getty.edu/page/aat/";
    const URI_RDFS = "http://www.w3.org/2000/01/rdf-schema#";
    const URI_SKOS = "http://www.w3.org/2004/02/skos/core#";

    const ART_MEDIA = [
        'acrylic'=>'aat:300015058',
        'canvas'=>'aat:300014078',
        'cardboard'=>'aat:300014224',
        'charcoal'=>'aat:300022414',
        'crayon'=>'aat:300022415',
        'ink'=>'aat:300015012',
        'marker' => 'aat:300022457',
        'marker pen' => 'aat:300022458',
        'mixed media' => 'aat:300163347',
        'oil'=>'aat:300015050',
        'paper'=>'aat:300014109',
        'pastel'=>'aat:300122621',
        'pencil'=>'aat:300410335',
        'watercolour'=>'aat:300015045',
        'wood'=>'aat:300011914',
    ];

    const ART_TYPES = [
        'acrylic painting'=>'aat:300181918',
        'aquarelle' => 'aat:300404216',
        'assemblage'=>'aat:300047194',
        'collage'=>'aat:300033963',
        'drawing'=>'aat:300033973',
        'drypoint'=>'aat:300041349',
        'gouache' => 'aat:300078928',
        'lithography'=>'aat:300041379',
        'oil painting'=>'aat:300033799',
        'poster'=>'aat:300027221',
        'work on paper' => 'aat:300189621'
    ];

    private array $terms = [];

    public static function getUrl($term): string {
        return self::URI_AAT . explode(':', $term)[1];
    }

    public static function getRdfUrl($term): string {
        return self::URI_AAT . explode(':', $term)[1].'.rdf';
    }

    public static function getPageUrl($term): string {
        return self::URI_AAT_PAGE . explode(':', $term)[1];
    }

    function __construct() {
        $aatData = $this->load();
        foreach ($aatData["aat"] as $term => $data) {
            $labels = [];
            foreach ($data as $arr) {
                $labels[] = new AATLabel($arr["language"], $arr["literal"], $arr["type"], $arr["displayed"]);
            }
            $this->terms[$term] = $labels;
        }
    }

    /**
     * @param string[] $types
     * @return array[] array(term => AATLabels[])
     */
    public function getTypes(array $types): array {
        $all = [];
        foreach ($types as $type) {
            $term = self::ART_TYPES[strtolower($type)] ?? false;
            if ($term) $all[$term] = $this->getPreferredLabels($term);
        }
        return $all;
    }

    /**
     * @param string $mediaString
     * @return array[] array(term => AATLabels[])
     */
    public function getMedia(string $mediaString): array {
        $all = [];
        $subject = strtolower($mediaString);
        foreach (array_keys(self::ART_MEDIA) as $word) {
            if (str_contains($subject, $word)) {
                $term = self::ART_MEDIA[$word];
                $all[$term] = $this->getPreferredLabels($term);
            }
        }
        return $all;
    }


    /**
     * @param string $term
     * @return AATLabel[]
     */
    public function getDisplayedLabels(string $term): array {
        $labels = [];
        foreach ($this->getAllLabels($term) as $label) {
            if ($label->isDisplayed()) $labels[] = $label;
        }
        return $labels;
    }

    /**
     * Get skos:prefLabels for given term
     * @param string $term aat:xxx
     * @return AATLabel[]
     */
    public function getPreferredLabels(string $term): array {
        $labels = [];
        foreach ($this->getAllLabels($term) as $label) {
            if ($label->getType() == "skos:prefLabel") $labels[] = $label;
        }
        return $labels;
    }

    /**
     * Get all labels for given term
     * @param string $term aat:xxx
     * @return AATLabel[]
     */
    public function getAllLabels(string $term): array {
        return $this->terms[$term] ?? [];
    }

    /**
     * Generate the json file that is the basis of this class $terms array
     * @return void
     * @throws Exception
     */
    public function generateJson(): void {
        $this->terms = [];
        foreach (array_keys($this->allTerms()) as $term) {
            $labels = $this->getLabels($term);
            $this->terms[$term] = $labels;
        }
        $this->persist();
    }

    /**
     * Gets ART_MEDIA and ART_TYPES reversed
     *
     * Gets array "aat:xxx" => "name[;name...]"
     * @return array<string, string>
     */
    public function allTerms(): array {
        $allTerms = [];
        $this->collectTerms(self::ART_MEDIA, $allTerms);
        $this->collectTerms(self::ART_TYPES, $allTerms);
        ksort($allTerms);
        return $allTerms;
    }

    private function collectTerms(array $constants, array &$allTerms): void {
        foreach ($constants as $desc => $term) {
            if (is_null($allTerms[$term])) {
                $allTerms[$term] = $desc;
            } else {
                $allTerms[$term] = $allTerms[$term] . ";" . $desc;
            }
        }
    }

    private function load(): array {
        if (!file_exists($this->getFilename())) return [];
        return json_decode(file_get_contents($this->getFilename()), true);
    }

    public function serialize(): string {
        return json_encode(["aat" => $this->terms], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function persist(): void {
        file_put_contents($this->getFilename(), $this->serialize(), LOCK_EX);
    }

    public function getFilename(): string {
        return Env::dataDir() . "/aat/aat.json";
    }

    /**
     * Get labels for the given term
     *
     * Collects literals of term typed as *rdfs:label*, *skos:prefLabel* and *skos:altLabel*.
     *
     * @param string $term
     * @return AATLabel[]
     * @throws Exception
     */
    private function getLabels(string $term): array {
        RdfNamespace::set("aat", AAT::URI_AAT);
        RdfNamespace::set("rdfs", AAT::URI_RDFS);
        RdfNamespace::set("skos", AAT::URI_SKOS);
        $g = $this->getGraph($term);
        $labels = [];
        $this->collectLabels($g->allLiterals($term, "rdfs:label"),$labels, "rdfs:label");
        $this->collectLabels($g->allLiterals($term, "skos:prefLabel"),$labels, "skos:prefLabel");
        $this->collectLabels($g->allLiterals($term, "skos:altLabel"),$labels, "skos:altLabel");
        usort($labels, function ($a, $b) {
            if ($a->getLanguage() == $b->getLanguage()) return 0;
            return ($a->getLanguage() < $b->getLanguage()) ? -1 : 1;
        });
        return $labels;
    }

    private function collectLabels(array $literals, array &$labels, string $type): void {
        /** @var Literal $literal */
        foreach ($literals as $literal) {
            $labels[] = new AATLabel($literal->getLang(), $literal->getValue(), $type);

        }
    }

    /**
     * Get the Graph of the given $term
     *
     * Graph will be loaded from file. If the file does not exist, file will be downloaded
     * from http://vocab.getty.edu/aat/
     *
     * @param string $term the prefixed id of the term, something like aat:300011914
     * @return Graph
     * @throws Exception
     */
    public function getGraph(string $term): Graph {
        $name = str_replace(':', '_', $term).'.rdf';
        $filename = Env::dataDir() . "/aat/$name";
        if (!file_exists($filename)) {
            $url = self::URI_AAT . explode(':', $term)[1].'.rdf';
            $ch = curl_init($url);
            $fp = fopen($filename, 'w+');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            if(curl_errno($ch)){
                throw new Exception(curl_error($ch));
            }
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            fclose($fp);
            if($statusCode != 200){
                throw new Exception('statusCode: '.$statusCode);
            }
        }
        $g = new Graph();
        $g->parseFile($filename);
        return $g;
    }


}