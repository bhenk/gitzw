<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\dat\Store;
use Exception;

class CreatorPageControl {

    /**
     * @param string $path
     * @return bool
     * @throws Exception
     */
    public function renderPage(string $path): bool {
        $creator = Store::creatorStore()->selectByName($path);
        if (!$creator) return false;

        //Redirect?
        $long_url = $creator->getUriName();
        if (($path != $long_url)) {
            Site::redirect($long_url);
            return true;
        }

        echo "<h1>" . self::class . "</h1>";
        echo "<h2>" . $creator->getCRID() . "</h2>";
        echo $creator->getFullName();
        return true;
    }

}