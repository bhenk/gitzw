<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use function array_diff;
use function array_reverse;
use function array_values;
use function basename;
use function count;
use function explode;
use function in_array;
use function is_dir;
use function is_file;
use function move_uploaded_file;
use function scandir;
use function set_error_handler;
use function str_replace;
use function str_starts_with;

/**
 * Handles uploading of files
 *
 * For REQUEST_METHOD POST:
 *
 * * action == upload => doUpload(): files in tmp moved to /uploads > 1
 * * action == uploaded => handleUploaded(): -<
 *    * deleteSelected => showConfirmDelete() > 1 or 2
 *    * moveSelected => showMoveFiles() > 1 or 4
 * * action = confirmDelete => doDelete() > 1
 * * action = moveFiles => doMoveFiles() > 1 or directory
 */
class UploadControl extends Page3cControl {

    const MODE_UPLOADED_FILES = 1;
    const MODE_CONFIRM_DELETE = 2;
    const MODE_MOVE_FILES = 4;

    private int $mode = self::MODE_UPLOADED_FILES;
    private array $files_to_handle = [];
    private string $error_msg = "";

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/upload.css");
        $this->setPageTitle("Upload");
    }

    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["action"] == "upload") $this->doUpload();
            if ($_POST["action"] == "uploaded") $this->handleUploaded();
            if ($_POST["action"] == "confirmDelete") $this->doDelete();
            if ($_POST["action"] == "moveFiles") $this->doMoveFiles();
        } else {
            $this->mode = self::MODE_UPLOADED_FILES;
        }
    }

    private function doUpload(): void {
        $new_files = [];
        if(isset($_POST["submit"])) {
            foreach ($_FILES["the_files"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["the_files"]["tmp_name"][$key];
                    $new_files[$key] = Env::public_html() . "/uploads/" . basename($_FILES["the_files"]["name"][$key]);
                    move_uploaded_file($tmp_name, $new_files[$key]);
                }
            }
        }
        $this->mode = self::MODE_UPLOADED_FILES;
    }

    private function handleUploaded(): void {
        $deleteSelected = $_POST["deleteSelected"] ?? false;
        if ($deleteSelected) $this->showConfirmDelete();
        $moveSelected = $_POST["moveSelected"] ?? false;
        if ($moveSelected) $this->showMoveFiles();
    }

    private function showConfirmDelete(): void {
        $this->buildFilesToHandle();
        if (empty($this->files_to_handle)) {
            $this->mode = self::MODE_UPLOADED_FILES;
        } else {
            $this->mode = self::MODE_CONFIRM_DELETE;
        }
    }

    private function doDelete(): void {
        $doDelete = $_POST["doDelete"] ?? false;
        if ($doDelete) { // otherwise cancel delete
            $files_to_delete = explode(";", $_POST["files_to_delete"]);
            $dir = Env::public_html() . "/uploads";
            $files = array_values(array_diff(scandir($dir), array('..', '.')));
            for ($i = 0; $i < count($files); $i++) {
                if (in_array($i, $files_to_delete)) unlink("$dir/$files[$i]");
            }
        }
        $this->mode = self::MODE_UPLOADED_FILES;
    }

    private function showMoveFiles(): void {
        $this->buildFilesToHandle();
        if (empty($this->files_to_handle)) {
            $this->mode = self::MODE_UPLOADED_FILES;
        } else {
            $this->mode = self::MODE_MOVE_FILES;
        }
    }
    private function buildFilesToHandle(): void {
        $dir = Env::public_html() . "/uploads";
        $files = array_values(array_diff(scandir($dir), array('..', '.')));
        for ($i = 0; $i < count($files); $i++) {
            $in_post = $_POST["file_" . $i] ?? false;
            if ($in_post) $this->files_to_handle[] = $i;
        }
    }

    private function doMoveFiles(): void {
        $doMove = $_POST["doMove"] ?? false;
        if ($doMove) {
            $path = $_POST["path"];
            $dir_select = $_POST["dir_select"];
            $files_to_move = explode(";", $_POST["files_to_move"]);
            if (!empty($path)) {
                if ($this->isAllowedNewDir($path)) {
                    $dir_select = $path;
                } else {
                    $this->error_msg = "New destination '$path' not allowed";
                    $this->files_to_handle = $files_to_move;
                    $this->mode = self::MODE_MOVE_FILES;
                    return;
                }
            }
            $moveToDir = Env::dataDir() . "/" . $dir_select;
            if (!is_dir($moveToDir)) mkdir($moveToDir, 0777, true);
            $dir = Env::public_html() . "/uploads";
            $files = array_values(array_diff(scandir($dir), array('..', '.')));
            for ($i = 0; $i < count($files); $i++) {
                if (in_array($i, $files_to_move)) {
                    $from = Env::public_html() . "/uploads/" . $files[$i];
                    $toName = str_replace(" ", "-", $files[$i]);
                    $to = $moveToDir . "/" . $toName;
                    if (is_file($to)) {
                        $this->error_msg .= " - file already exists: $to <br/>";
                    } else {
                        rename($from, $to);
                        $rel = "$dir_select/" . $toName;
                        $repid = str_replace(Representation::IMG_DIR . "/", "", $rel);
                        $rep = new Representation();
                        $rep->setREPID($repid);
                        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
                            $msg = " - while reading exif data<br/>"
                                . " - - errno=$errno<br/>"
                                . " - - errstr=$errstr<br/>"
                                . " - - errfile=$errfile<br/>"
                                . " - - errline=$errline<br/>";
                            $this->error_msg .= $msg;
                        });
                        $exif = $rep->getExifData();
                        restore_error_handler();
                        $dateTime = $exif["EXIF"]["DateTimeOriginal"] ?? null;
                        if (is_null($dateTime)) {
                            $dateTime = $exif["IFD0"]["DateTime"] ?? null;
                        }
                        $model = $exif["IFD0"]["Model"] ?? null;
                        if ($model) $rep->setSource($model);
                        if ($dateTime) $rep->setDate($dateTime);
                        Store::representationStore()->persist($rep);
                    }
                }
            }
            if (!empty($this->error_msg)) {
                $this->files_to_handle = $files_to_move;
                $this->mode = self::MODE_MOVE_FILES;
            } else {
                // redirect to directory
                Site::redirect("/admin/explore/$dir_select");
            }
        } else { // cancel
            $this->mode = self::MODE_UPLOADED_FILES;
        }
    }

    private function isAllowedNewDir(string $path): bool {
        if (str_starts_with($path, "images/")) return true;
        return false;
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_UPLOADED_FILES => "/admin/upload/uploaded_files.php",
            self::MODE_CONFIRM_DELETE => "/admin/upload/confirm_delete.php",
            self::MODE_MOVE_FILES => "/admin/upload/move_files.php"

        };
        require_once Env::templatesDir() . $template;
    }

    public function getFilesToHandle(): array {
        return $this->files_to_handle;
    }

    public function getErrorMsg(): string {
        return $this->error_msg;
    }

    public function getDestinationOptions(): array {
        $base = Env::dataDir() . "/images";
        $array = [];
        $this->scanDestinationDirs($base, "images", $array);
        return array_reverse($array);
    }

    private function scanDestinationDirs($dir, $path, &$array): void {
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $file) {
            if (is_dir("$dir/$file")) {
                $array[] = "$path/$file";
                $this->scanDestinationDirs("$dir/$file", "$path/$file", $array);
            }
        }
    }

}