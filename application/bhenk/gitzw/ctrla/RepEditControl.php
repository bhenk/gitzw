<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use function file_exists;
use function is_null;
use function substr;
use function unlink;

/**
 * Class handles editing of Representations
 *
 * Path: /admin/image/{REPID}
 *
 * How to get there a.o.: Admin > File > Explore, choose directory, choose image
 */
class RepEditControl extends Page3cControl {

    const MODE_EDIT = 0;
    const MODE_DELETED = 1;

    private int $mode = self::MODE_EDIT;
    private Representation $representation;
    private array $errors = [];
    private array $messages = [];

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/image.css");
        $this->setPageTitle("Edit image");
    }

    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
        $repid = $this->getRequest()->getLastParts(3);
        $this->representation = Store::representationStore()->selectByREPID($repid);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePost();
        }
    }

    private function handlePost(): void {
        $submit = $_POST["submit"] ?? "";
        if ($submit == "Save") $this->handleSavePost();
        if ($submit == "Delete") $this->handleDeletePost();
    }

    private function handleSavePost(): void {
        $repr = $this->getRepresentation();
        // date and source are disabled
        $date = $_POST["date"] ?? $repr->getDate();
        $source =  $_POST["source"] ?? $repr->getSource();
        $repr->setDate($date);
        if (!is_null($source)) $repr->setSource($source);
        $repr->setDescription($_POST["description"]);
        Store::representationStore()->persist($repr);
    }

    private function handleDeletePost(): void {
        $repr = $this->getRepresentation();
        if (!Store::representationStore()->representationCanBeDeleted($repr)) {
            $this->errors = Store::representationStore()->getMessages();
        } else {
            $file = $repr->getFilename();
            if (file_exists($file)) {
                if (unlink($file)) {
                    $this->messages[] = "deleted: " . $file;
                } else {
                    $this->errors[] = "could not delete: " . $file;
                }
            }
            $files = Images::getFileLocations($repr->getREPID());
            foreach ($files as $file) {
                if (unlink($file)) {
                    $this->messages[] = "deleted: " . $file;
                } else {
                    $this->errors[] = "could not delete: " . $file;
                }
            }
        }
        Store::representationStore()->delete($repr);
        $this->mode = self::MODE_DELETED;
    }

    public function getRepresentation(): Representation {
        return $this->representation;
    }

    public function isDeleteEnabled(): bool {
        return (bool)Store::representationStore()->representationCanBeDeleted($this->getRepresentation());
    }

    /**
     * @return array
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getMessages(): array {
        return $this->messages;
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_EDIT => "/admin/reps/edit.php",
            self::MODE_DELETED => "/admin/reps/deleted.php"
        };
        require_once Env::templatesDir() . $template;
    }

}