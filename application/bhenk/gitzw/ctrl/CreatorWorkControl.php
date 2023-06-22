<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Images;
use bhenk\gitzw\dat\Creator;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;

class CreatorWorkControl extends Page1cControl {

    const MODE_WORK = 0;
    const MODE_CAT = 1;
    private Creator $creator;
    private WorkCategories $category;
    private int $mode;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->creator = $request->getCreator();
        if ($request->hasWorkCategory()) {
            $this->category = $request->getWorkCategory();
            $this->addStylesheet("/css/home/creator_cat.css");
            $this->mode = self::MODE_CAT;
        } else {
            $this->addStylesheet("/css/home/creator_work.css");
            $this->mode = self::MODE_WORK;
        }
        $request->setUseCache(true);
    }

    public function handleRequest(): void {
        $pf = ($this->mode == self::MODE_CAT) ? " - " . $this->getCategory()->value : "";
        $this->setPageTitle($this->creator->getFullName() . $pf);
    }

    function renderContainer(): void {
        $template = match ($this->mode) {
            self::MODE_WORK => "/home/creator_work.php",
            self::MODE_CAT => "/home/creator_cat.php"
        };
        require_once Env::templatesDir() . $template;
    }

    public function getCreator(): Creator {
        return $this->creator;
    }

    public function getCategory(): WorkCategories {
        return $this->category;
    }

    public function getData(): array {
        $data = [];
        $categories = [WorkCategories::paint, WorkCategories::draw, WorkCategories::dry];
        foreach ($categories as $cat) {
            $data[$cat->name] = $this->getCreator()->getImageData($cat, Images::IMG_04, 0, 200);
        }
        return $data;
    }

    public function getCatData(): array {
        return $this->getCreator()->getImageData($this->getCategory(), Images::IMG_15, 0, 200);
    }

    public function getCatYears(): array {
        $years = [];
        $result = Store::workStore()->selectCatYear($this->creator->getShortCRID());
        foreach ($result as $item) {
            if ($item["category"] == $this->getCategory()->name) {
                $url = "/" . $this->creator->getUriName() . "/work/"
                    . $this->getCategory()->value . "/" . $item["year"];
                $years[$item["year"]] = $url;
            }
        }
        return $years;
    }
}