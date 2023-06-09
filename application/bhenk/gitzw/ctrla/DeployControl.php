<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dat\CreatorIterator;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\dat\WorkIterator;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;
use function curl_close;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function set_time_limit;

class DeployControl extends \bhenk\gitzw\ctrl\Page3cControl {

    const MODE_INITIAL = 0;

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

    private function updateOrder(): void {
        $where = "1 = 1 ORDER BY `category`, YEAR(`date`), `ordinal`";
        Store::workStore()->iterate(function ($count, $work) {
            /** @var Work $work */
            $work->setOrder($count);
            $this->update_order_count = $count;
        }, $where);
        $this->setPageTitle("Deploy - update order");
    }

    private function createCache(): void {
        $this->errors = [];
        if (!Env::useCache()) {
            $this->errors[] = "useCache = false: Cannot create cache";
            return;
        }
        set_time_limit(0);
        $this->clearCache();
        $count = 0;
        $count += $this->createYearViewCache();
        $count += $this->createWorkViewCache();
        $this->create_cache_count = $count;
        $this->setPageTitle("Deploy - create cache");
    }

    private function clearCache(): void {
        $files = glob(Env::cacheDir() . "/*.html");
        foreach ($files as $file) {
            unlink($file);
        }
    }

    private function createYearViewCache(): int {
        $count = 0;
        $iter = new CreatorIterator();
        while ($iter->hasNext()) {
            $creator = $iter->next();
            $shortCrid = $creator->getShortCRID();
            $href = Env::HTTPS_URL . "/" . $creator->getUriName() . "/work";
            $result = Store::workStore()->selectCatYear($shortCrid);
            foreach ($result as $item) {
                $cat = $item["category"];
                $year = $item["year"];
                $category = WorkCategories::forName($cat);
                $href_ = "$href/$category->value/$year";
                $this->callUrl($href_);
                $count++;
            }
        }
        return $count;
    }

    private function createWorkViewCache(): int {
        $iter = new WorkIterator();
        while ($iter->hasNext()) {
            $work = $iter->next();
            $loc = Env::HTTPS_URL . "/" . $work->getCanonicalUrl();
            $this->callUrl($loc);
        }
        return $iter->getCount();
    }

    private function callUrl(string $loc): void {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $loc);
        curl_setopt($handle, CURLOPT_HEADER  , true);  // we want headers
        curl_setopt($handle, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($handle, CURLOPT_TIMEOUT,10);
        curl_setopt($handle, CURLOPT_MAXREDIRS, 10);
        curl_exec($handle);
        print curl_error($handle);
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

    public function getErrors(): array {
        return $this->errors;
    }

}