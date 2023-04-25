<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\dat\Store;
use bhenk\gitzw\model\WorkCategories;
use Exception;
use function count;
use function implode;
use function is_null;

class WorkPageControl {

    /**
     * @param array $path
     * @param bool $id_path
     * @return bool
     * @throws Exception
     */
    public function renderPage(array $path, bool $id_path = false): bool {
        // long-name-string, work, long-act, 2020, 0001
        if (count($path) < 5) return false;
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

        echo "<h1>" . self::class . "</h1>";
        echo $work->getTitles() . "<br/>";
        $representations = $work->getRelations()->getRepresentations();
        echo "<h3>Representations</h3>";
        foreach ($representations as $representation) {
            echo $representation->getFilename() . "<br/>";
        }
        return true;
    }

}