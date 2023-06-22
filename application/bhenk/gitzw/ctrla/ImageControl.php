<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Request;
use function is_null;
use function substr;

/**
 * Class handles editing of Representations
 *
 * Path: /admin/image/{REPID}
 *
 * How to get there a.o.: Admin > File > Explore, choose directory, choose image
 */
class ImageControl extends Page3cControl {

    const MODE_EDIT = 0;

    private int $mode = self::MODE_EDIT;


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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePost();
        }
    }

    private function handlePost(): void {
        $repr = $this->getRepresentation();
        // date and source are disabled
        $date = $_POST["date"] ?? $repr->getDate();
        $source =  $_POST["source"] ?? $repr->getSource();
        $repr->setDate($date);
        if (!is_null($source)) $repr->setSource($source);
        $repr->setDescription($_POST["description"]);
        Store::representationStore()->persist($repr);
    }

    public function getRepresentation(): Representation {
        $repid = substr($this->getRequest()->getCleanUrl(), 12);
        return Store::representationStore()->selectByREPID($repid);
    }

    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        $template = match ($this->mode) {
            self::MODE_EDIT => "/admin/image/edit.php",
        };
        require_once Env::templatesDir() . $template;
    }
}