<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use Exception;
use function array_diff;
use function glob;
use function is_dir;
use function scandir;
use function stat;
use function substr;

class FileExplorerControl extends Page3cControl {

    const MODE_OVERVIEW = 0;
    const MODE_DIRECTORY_VIEW = 1;

    private int $mode = self::MODE_OVERVIEW;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/explore.css");
    }

    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
        $act = $this->getRequest()->getUrlPart(2);
        if ($act == "") {
            $this->mode = self::MODE_OVERVIEW;
            $this->setPageTitle("File explorer");
        } else {
            $this->mode = self::MODE_DIRECTORY_VIEW;
            $this->setPageTitle("Explore image directory");
        }
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_OVERVIEW => "/admin/explore/overview.php",
            self::MODE_DIRECTORY_VIEW => "/admin/explore/directory_view.php"
        };
        require_once Env::templatesDir() . $template;
    }

    public function getImageDirectories(): array {
        $base = Env::dataDir() . "/images";
        $array = [];
        $this->scanImageDirs($base, "images", $array);
        return $array;
    }

    private function scanImageDirs($dir, $path, &$array): void {
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $file) {
            if (is_dir("$dir/$file")) {
                $array["$path/$file"] = $this->countFiles("$dir/$file");
                $this->scanImageDirs("$dir/$file", "$path/$file", $array);
            }
        }
    }

    private function countFiles(string $dir): array {
        $dirs = count(glob( $dir ."/*", GLOB_ONLYDIR));
        $allFiles = glob($dir . "/*.*");
        $files = count($allFiles);
        $bytes = 0;
        foreach ($allFiles as $file) {
            $bytes += stat($file)["size"];
        }
        return [$dirs, $files, $bytes];
    }

    public function getPath(): string {
        return substr($this->getRequest()->getCleanUrl(), 14);
    }

    /**
     * @param string $path
     * @return array<int, Representation[]>
     * @throws Exception
     */
    public function getDirectoryContents(string $path): array {
        $dir = Env::dataDir() . "/$path";
        $files = array_diff(scandir($dir), array('..', '.'));
        $repids = [];
        $repStart = substr($path, 7);
        $bytes = 0;
        foreach ($files as $file) {
            $repids[] = $repStart . "/$file";
            $bytes += stat("$dir/$file")["size"];
        }
        return [$bytes, Store::representationStore()->selectBatchByRepid($repids)];
    }
}