<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\CreatorIterator;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\dat\WorkIterator;
use bhenk\gitzw\handle\Handler;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use function count;
use function curl_close;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function date;
use function glob;
use function intval;
use function session_start;
use function session_status;
use function session_write_close;
use function set_time_limit;
use function sleep;
use function time;

class DeployControl extends Page3cControl {

    const MODE_INITIAL = 0;

    const ID_PROGRESS_ORDER = "progress_order";
    const ID_PROGRESS_CACHE = "progress_cache";
    const ID_PROGRESS_SITEMAP = "progress_sitemap";

    private int $mode = self::MODE_INITIAL;

    private int $update_order_count = -1;
    private int $create_cache_count = -1;
    private array $errors = [];

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
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
        foreach ($args as $key => $value) {
            $_SESSION[$key] = $value;
        }
        session_write_close();
    }

    private function createSitemap(): void {

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
        $this->setPageTitle("Deploy - updated order");
    }

    private function createCache(): void {
        $total = count(glob(Env::cacheDir() . "/*.html"));
        if ($total < 2) $total = 300;
        $_SESSION["total_" . self::ID_PROGRESS_CACHE] = $total;
        $_SESSION["progress_" . self::ID_PROGRESS_CACHE] = 2;

        $this->errors = [];
        $this->create_cache_count = 0;
        if (!Env::useCache()) {
            $this->errors[] = "useCache = false: Cannot create cache";
            return;
        }
        set_time_limit(0);
        $this->clearCache();
        $this->createYearViewCache();
        $this->createWorkViewCache();
        $this->updateSession([
            "total_" . self::ID_PROGRESS_CACHE => $this->create_cache_count,
            "progress_" . self::ID_PROGRESS_CACHE => $this->create_cache_count,
            "msg_" . self::ID_PROGRESS_CACHE => date("H:i:s", time())
                . " created $this->create_cache_count pages",
        ]);
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

    public function getTotalWorks(): int {
        return Store::workStore()->countWhere("1=1");
    }

    public function getErrors(): array {
        return $this->errors;
    }

}