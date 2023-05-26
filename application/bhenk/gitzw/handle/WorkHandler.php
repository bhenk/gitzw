<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\WorkViewControl;
use bhenk\gitzw\ctrl\WorkYearViewControl;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;
use Exception;
use function count;
use function is_null;
use function strlen;
use function substr;

class WorkHandler extends AbstractHandler {

    /**
     * Handles *creator-full-name/work*, *crid/work* and *crid.work* uris
     *
     * Precondition: creator is set on request.
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function handleRequest(Request $request): void {
        $act = $request->getUrlPart(1);
        if ($act != "work") {
            $this->getNextHandler()->handleRequest($request);
            return;
        }

        $cat = $request->getUrlPart(2);
        if (empty($cat)) {
            $canonical = $request->getCreator()->getUriName() . "/work";
            if ($request->getCleanUrl() != $canonical) {
                Site::redirect("/" . $canonical);
            } else {
                $this->goWorkControl($request);
            }
            return;
        } else {
            $category = WorkCategories::get($cat);
            if (is_null($category)) {
                (new NotFoundHandler())->handleRequest($request);
                return;
            }
            $request->setWorkCategory($category);
        }

        $year = $request->getUrlPart(3);
        if (empty($year)) {
            $canonical = $request->getCreator()->getUriName() . "/work/" . $request->getWorkCategory()->value;
            if ($request->getCleanUrl() != $canonical) {
                Site::redirect("/" . $canonical);
            } else {
                $this->goWorkCatControl($request);
            }
            return;
        }

        $last = explode(".", $request->getUrlPart(4));
        $number = $last[0];
        $format = (count($last) > 1) ? $last[1] : false;
        if (empty($number)) {
            $canonical = $request->getCreator()->getUriName() . "/work/"
                . $request->getWorkCategory()->value . "/$year";
            if ($request->getCleanUrl() != $canonical) {
                Site::redirect("/" . $canonical);
            } else {
                $this->goWorkYearViewControl($request);
            }
            return;
        } elseif ($number == "view") {
            $this->goWorkYearViewControl($request);
            return;
        }

        $RESID = $request->getCreator()->getShortCRID() . ".work."
            . $request->getWorkCategory()->name . ".$year.$number";
        $work = Store::workStore()->selectByRESID($RESID);
        if (!$work) {
            (new NotFoundHandler())->handleRequest($request);
            return;
        }
        $request->setWork($work);
        $canonical = $work->getCanonicalUrl($request->getCreator());
        $cleanUrl = $request->getCleanUrl();
        if ($format) $cleanUrl = substr($request->getCleanUrl(), 0, - (strlen($format) + 1));
        if ($cleanUrl != $canonical) {
            Site::redirect("/" . $canonical);
            return;
        }
        $request->setFormat($format);
        $this->goWorkViewControl($request);
    }

    private function goWorkViewControl(Request $request): void {
        $ctrl = new WorkViewControl($request);
    }

    private function goWorkYearViewControl(Request $request): void {
        $ctrl = new WorkYearViewControl($request);
    }

    private function goWorkCatControl(Request $request): void {
        echo "work cat control = under construction";
    }

    private function goWorkControl(Request $request): void {
        echo "work control = under construction";
    }

}