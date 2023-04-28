<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\dat\Creator;
use bhenk\gitzw\dat\Store;
use Exception;

class CreatorPageControl extends PageControl {

    private Creator $creator;

    /**
     * @param array|string $path
     * @return bool
     * @throws Exception
     */
    public function canHandle(array|string $path): bool {
        $creator = Store::creatorStore()->selectByName($path);
        if (!$creator) return false;

        //Redirect?
        $long_url = $creator->getUriName();
        if (($path != $long_url)) {
            Site::redirect($long_url);
            return true;
        }
        $this->creator = $creator;
        $this->renderPage();
        return true;
    }

    /**
     * @return void
     */
    public function renderPage(): void {

        echo "<h1>" . self::class . "</h1>";
        echo "<h2>" . $this->creator->getCRID() . "</h2>";
        echo $this->creator->getFullName();
    }

}