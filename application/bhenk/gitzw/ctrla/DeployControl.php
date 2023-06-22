<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dajson\Registry;
use bhenk\gitzw\dat\CreatorIterator;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\dat\WorkIterator;
use bhenk\gitzw\handle\AjaxResponse;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use PHPUnit\TextUI\XmlConfiguration\Exception;
use XMLWriter;
use function count;
use function curl_close;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_multi_getcontent;
use function curl_setopt;
use function date;
use function glob;
use function is_null;
use function rename;
use function set_time_limit;
use function sha1;
use function time;

class DeployControl extends Page3cControl {

    const MODE_INITIAL = 0;

    const ID_PROGRESS_ORDER = "progress_order";
    const ID_PROGRESS_CACHE = "progress_cache";
    const ID_PROGRESS_SITEMAP = "progress_sitemap";

    private int $mode = self::MODE_INITIAL;

    private int $update_order_count = -1;
    private int $create_cache_count = -1;
    private int $create_sitemap_count = -1;
    private int $sitemaps_changed = 0;
    private array $errors = [];
    private ?AjaxResponse $ajax_response = null;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/deploy.css");
    }

    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
        $this->setPageTitle("Deploy");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["action"] == "update_order") $this->updateOrder();
            if ($_POST["action"] == "create_cache") $this->createCache();
            if ($_POST["action"] == "create_sitemap") $this->createSitemap();
        } else {
            $act = $this->getRequest()->getUrlPart(2);
            if ($act == "") $this->showInitial();
        }
    }

    private function showInitial(): void {
        $this->setPageTitle("Deploy");
        $this->mode = self::MODE_INITIAL;
    }

    private function updateSession(array $args): void {
        if (is_null($this->ajax_response)) $this->ajax_response = new AjaxResponse();
        $this->ajax_response->updateStatus($args);
    }

    private function createSitemap(): void {
        if (!Env::useCache()) {
            $this->errors[] = "useCache = off: No Sitemap is made.";
            return;
        }
        $this->create_sitemap_count = 0;
        $this->sitemaps_changed = 0;
        $sm_filename = $this->getSitemapFilename();
        $tmp_filename = $sm_filename . ".new";
        $sm_registry = Registry::sitemapRegistry();
        $total = count($sm_registry->getEntries());
        if ($total < 2) $total = 300;
        $_SESSION["total_" . self::ID_PROGRESS_SITEMAP] = $total;
        $_SESSION["progress_" . self::ID_PROGRESS_SITEMAP] = 0;

        $xw = new XMLWriter();
        $xw->openUri($tmp_filename);
        $xw->setIndent(true);
        $xw->setIndentString("   ");
        $xw->startDocument('1.0', 'UTF-8');

        $xw->startElementNs(null, 'urlset', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xw->writeAttributeNs('xmlns', 'image', null, 'http://www.google.com/schemas/sitemap-image/1.1');
        // homepage
        $this->writeEntry($xw, "");
        $this->updateSession([
            "progress_" . self::ID_PROGRESS_SITEMAP => $this->create_sitemap_count,
        ]);
        $this->createSmYearViews($xw);
        $this->createSmWorkViews($xw);

        $xw->endElement();
        $xw->endDocument();
        $xw->flush();
        $sm_registry->persist();
        rename($tmp_filename, $sm_filename);
        $this->updateSession([
            "total_" . self::ID_PROGRESS_SITEMAP => $this->create_sitemap_count,
            "progress_" . self::ID_PROGRESS_SITEMAP => $this->create_sitemap_count,
            "msg_" . self::ID_PROGRESS_SITEMAP => date("H:i:s", time())
                . " created $this->create_sitemap_count entries, $this->sitemaps_changed pages have changed",
        ]);
        $registry = Registry::actionRegistry();
        $registry->getActionByAcid("SITEMAP")
            ->setLastModified($this->getRequest()->getSessionUser()->getName());
        $registry->persist();
        $this->setPageTitle("Deploy - created sitemap");
    }

    private function createSmYearViews(XMLWriter $xw): void {
        Log::info("Creating sitemap entries for year views");
        $iter = new CreatorIterator();
        while ($iter->hasNext()) {
            $creator = $iter->next();
            $shortCrid = $creator->getShortCRID();
            $href = "/" . $creator->getUriName() . "/work";
            $result = Store::workStore()->selectCatYear($shortCrid);
            $this->updateSession([
                "msg_" . self::ID_PROGRESS_SITEMAP => "Creating " . count($result) . " sitemap entries for year views",
            ]);
            foreach ($result as $item) {
                $cat = $item["category"];
                $year = $item["year"];
                $category = WorkCategories::forName($cat);
                $href_ = "$href/$category->value/$year";
                $this->writeEntry($xw, $href_);
                $this->updateSession([
                    "progress_" . self::ID_PROGRESS_SITEMAP => $this->create_sitemap_count,
                ]);
            }
        }
    }

    private function createSmWorkViews(XMLWriter $xw): void {
        Log::info("Creating sitemap entries for work views");
        $this->updateSession([
            "msg_" . self::ID_PROGRESS_SITEMAP => "Creating sitemap entries for work view pages",
        ]);
        $iter = new WorkIterator("`hidden` = 0");
        while ($iter->hasNext()) {
            $work = $iter->next();
            $representation = $work->getRelations()->getPreferredRepresentation();
            $cr_name = $work->getCreator()->getFullName();
            $options = [];
            $options["image"] = [
                "imgLoc" => Env::HTTPS_URL . $representation->getFileLocation(Images::IMG_15),
                "imgCaption" => $cr_name . " - " . $work->getTitles("no title") . " - " . $work->getMedia(),
            ];
            $href_ = "/" . $work->getCanonicalUrl();
            $this->writeEntry($xw, $href_, $options);
            $this->writeEntry($xw, $href_ . ".json");
            $this->updateSession([
                "progress_" . self::ID_PROGRESS_SITEMAP => $this->create_sitemap_count,
            ]);
        }
    }

    private function writeEntry(XMLWriter $xw, string $loc, array $options=[]): void {
        $lastModified = $this->getLastModified($loc);
        $xw->startElement('url');

        $xw->startElement('loc');
        $xw->text(Env::HTTPS_URL.$loc);
        $xw->endElement();

        $xw->startElement('lastmod');
        $xw->text($lastModified);
        $xw->endElement();

        if (isset($options['image'])) {
            $image = $options["image"];
            $xw->startElement('image:image');

            $xw->startElement('image:loc');
            $xw->text($image['imgLoc']);
            $xw->endElement();

            $xw->startElement('image:caption');
            $xw->text($image['imgCaption']);
            $xw->endElement();

            $xw->startElement('image:license');
            $xw->text('https://creativecommons.org/licenses/by-nc-nd/4.0/');
            $xw->endElement();

            $xw->endElement(); // image:image
        }

        $xw->endElement(); // url

        $this->create_sitemap_count++;
    }

    private function getLastModified(string $loc): string {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, Env::HTTPS_URL.$loc);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($handle, CURLOPT_TIMEOUT,10);
        curl_setopt($handle, CURLOPT_MAXREDIRS, 10);
        curl_exec($handle);
        $error = curl_error($handle);
        if ($error != '') {
            throw new Exception('error in url "'.$loc.'" '.$error);
        }
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            throw new Exception('wrong code for url "'.$loc.'" '.$httpCode);
        }
        $content = curl_multi_getcontent($handle);
        curl_close($handle);
        $entry = Registry::sitemapRegistry()->getEntryByPath($loc);
        $changed = $entry->setSha1(sha1($content));
        if ($changed) $this->sitemaps_changed++;
        return $entry->getLastModified();
    }

    private function updateOrder(): void {
        $_SESSION["total_" . self::ID_PROGRESS_ORDER] = $this->getTotalWorks();
        $_SESSION["progress_" . self::ID_PROGRESS_ORDER] = 0;

        $where = "1 = 1 ORDER BY `category`, YEAR(`date`), `ordinal`";
        Store::workStore()->iterate(function ($count, $work) {
            /** @var Work $work */
            $work->setOrder($count);
            $this->update_order_count = $count;
            $this->updateSession([
                "progress_" . self::ID_PROGRESS_ORDER => $count,
                "msg_" . self::ID_PROGRESS_ORDER => $work->getCategory()->name,
            ]);
        }, $where);
        $this->updateSession([
            "total_" . self::ID_PROGRESS_ORDER => $this->update_order_count,
            "progress_" . self::ID_PROGRESS_ORDER => $this->update_order_count,
            "msg_" . self::ID_PROGRESS_ORDER => date("H:i:s", time())
                . " updated $this->update_order_count records",
        ]);
        $registry = Registry::actionRegistry();
        $registry->getActionByAcid("UOOW")
            ->setLastModified($this->getRequest()->getSessionUser()->getName());
        $registry->persist();
        $this->setPageTitle("Deploy - updated order");
    }

    private function createCache(): void {
        if (!Env::useCache()) {
            $this->errors[] = "useCache = off: Cannot create cache";
            return;
        }
        $total = count(glob(Env::cacheDir() . "/*.html"));
        if ($total < 2) $total = 300;
        $_SESSION["total_" . self::ID_PROGRESS_CACHE] = $total;
        $_SESSION["progress_" . self::ID_PROGRESS_CACHE] = 2;

        $this->errors = [];
        $this->create_cache_count = 0;

        set_time_limit(0);
        $this->clearCache();
        $this->createCreatorViewCache();
        $this->createYearViewCache();
        $this->createWorkViewCache();
        $this->updateSession([
            "total_" . self::ID_PROGRESS_CACHE => $this->create_cache_count,
            "progress_" . self::ID_PROGRESS_CACHE => $this->create_cache_count,
            "msg_" . self::ID_PROGRESS_CACHE => date("H:i:s", time())
                . " created $this->create_cache_count pages",
        ]);
        $registry = Registry::actionRegistry();
        $registry->getActionByAcid("CACHE")
            ->setLastModified($this->getRequest()->getSessionUser()->getName());
        $registry->persist();
        $this->setPageTitle("Deploy - created cache");
    }

    private function clearCache(): void {
        Log::info("Clearing cache");
        $this->updateSession([
            "msg_" . self::ID_PROGRESS_CACHE => "clearing cache",
        ]);
        $files = glob(Env::cacheDir() . "/*.html");
        foreach ($files as $file) {
            unlink($file);
        }
    }

    private function createCreatorViewCache(): void {
        Log::info("Creating cache for creator views");
        $this->updateSession([
            "msg_" . self::ID_PROGRESS_CACHE => "Creating creator view pages",
        ]);
        $iter = new CreatorIterator();
        while ($iter->hasNext()) {
            $creator = $iter->next();
            $href = "/" . $creator->getUriName();
            $this->callUrl($href);
            $this->create_cache_count++;
            foreach (WorkCategories::cases() as $cat) {
                $href_ = $href . "/work/" . $cat->value;
                $this->callUrl($href_);
                $this->create_cache_count++;
            }
            $this->updateSession([
                "progress_" . self::ID_PROGRESS_CACHE => $this->create_cache_count,
            ]);
        }
    }

    private function createYearViewCache(): void {
        Log::info("Creating cache for year views");
        $iter = new CreatorIterator();
        while ($iter->hasNext()) {
            $creator = $iter->next();
            $shortCrid = $creator->getShortCRID();
            $href = "/" . $creator->getUriName() . "/work";
            $result = Store::workStore()->selectCatYear($shortCrid);
            $this->updateSession([
                "msg_" . self::ID_PROGRESS_CACHE => "Creating " . count($result) . " year view pages",
            ]);
            foreach ($result as $item) {
                $cat = $item["category"];
                $year = $item["year"];
                $category = WorkCategories::forName($cat);
                $href_ = "$href/$category->value/$year";
                $this->callUrl($href_);
                $this->create_cache_count++;
                $this->updateSession([
                    "progress_" . self::ID_PROGRESS_CACHE => $this->create_cache_count,
                ]);
            }
        }
    }

    private function createWorkViewCache(): void {
        Log::info("Creating cache for work views");
        $this->updateSession([
            "msg_" . self::ID_PROGRESS_CACHE => "Creating work view pages",
        ]);
        $iter = new WorkIterator("`hidden` = 0");
        while ($iter->hasNext()) {
            $work = $iter->next();
            $href_ = "/" . $work->getCanonicalUrl();
            $this->callUrl($href_);
            $this->create_cache_count++;
            $this->updateSession([
                "progress_" . self::ID_PROGRESS_CACHE => $this->create_cache_count,
            ]);
        }
    }

    private function callUrl(string $loc): void {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, "http://127.0.0.1" . $loc);
        curl_setopt($handle, CURLOPT_HEADER  , true);  // we want headers
        curl_setopt($handle, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($handle, CURLOPT_TIMEOUT,10);
        curl_setopt($handle, CURLOPT_MAXREDIRS, 10);
        curl_exec($handle);
        //print curl_error($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            $this->errors[] = $httpCode . ": " . $loc;
        }
        curl_close($handle);
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_INITIAL=> "/admin/deploy/page.php",
        };
        require_once Env::templatesDir() . $template;
    }

    public function getUpdateOrderCount(): int {
        return $this->update_order_count;
    }

    public function getCreateCacheCount(): int {
        return $this->create_cache_count;
    }

    public function getCreateSitemapCount(): int {
        return $this->create_sitemap_count;
    }

    public function getTotalWorks(): int {
        return Store::workStore()->countWhere("1=1");
    }

    public function getSitemapFilename(): string {
        return Env::public_html() . "/sitemap.xml";
    }

    public function getCountSitemapEntries(): int {
        return count(Registry::sitemapRegistry()->getEntries());
    }

    public function getSMLastModifiedFilename(): string {
        return Registry::sitemapRegistry()->getFilename();
    }

    public function getErrors(): array {
        return $this->errors;
    }

}