<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\dat\Work;
use bhenk\gitzw\model\WorkCategories;
use Exception;
use function count;
use function explode;
use function implode;
use function is_null;
use function is_string;

class WorkPageControl extends PageControl {

    private Work $work;

    public function canHandle(array|string $path): bool {
        $id_path = false;
        if (is_string($path)) {
            $path = explode(".", $path);
            $id_path = true;
        }
        if (count($path) < 5) return false;
        $path = array_map( 'strtolower', $path );
        if ($path[1] != "work") return false;

        $creator = Store::creatorStore()->selectByName($path[0]);
        if (!$creator) return false;

        $cat = WorkCategories::get($path[2]);
        if (is_null($cat)) return false;

        $RESID = $creator->getShortCRID() . ".work.$cat->name.$path[3].$path[4]";
        $work = Store::workStore()->selectByRESID($RESID);
        if (!$work) return false;

        // Redirect??
        $url = implode("/", $path);
        $long_url = $creator->getUriName() . "/work/$cat->value/$path[3]/$path[4]";
        if (($url != $long_url) or $id_path) {
            Site::redirect($long_url);
            return true;
        }
        $this->work = $work;
        $this->renderPage();
        return true;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function renderPage(): void {
        echo "<h1>" . self::class . "</h1>";

        echo "<h2>" . $this->work->getRESID() . "</h2>";
        echo $this->work->getTitles() . "<br/>";
        $representations = $this->work->getRelations()->getRepresentations();
        echo "<h3>Representations</h3>";
        foreach ($representations as $representation) {
            echo $representation->getFilename() . "<br/>";
        }
    }

}