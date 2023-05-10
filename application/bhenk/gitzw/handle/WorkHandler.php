<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\WorkViewControl;
use bhenk\gitzw\ctrl\WorkYearViewControl;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;
use Exception;
use function is_null;

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

        $number = $request->getUrlPart(4);
        if (empty($number)) {
            $canonical = $request->getCreator()->getUriName() . "/work/"
                . $request->getWorkCategory()->value . "/$year";
            if ($request->getCleanUrl() != $canonical) {
                Site::redirect("/" . $canonical);
            } else {
                $this->goWorkYearControl($request);
            }
            return;
        } elseif ($number == "view") {
            $this->goWorkYearControl($request);
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
        if ($request->getCleanUrl() != $canonical) {
            Site::redirect("/" . $canonical);
            return;
        }
        $this->goWorkViewControl($request);
    }

    private function goWorkViewControl(Request $request): void {
        $ctrl = new WorkViewControl($request);
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }

    private function goWorkYearControl(Request $request): void {
        $ctrl = new WorkYearViewControl($request);
        /*$ctrl->handleRequest();*/
        /*$ctrl->renderPage();*/
    }

    private function goWorkCatControl(Request $request): void {
        echo "work cat control = under construction";
    }

    private function goWorkControl(Request $request): void {
        echo "work control = under construction";
    }

}