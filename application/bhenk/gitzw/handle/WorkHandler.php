<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\WorkPageControl;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\model\WorkCategories;
use bhenk\gitzw\site\Request;
use function is_null;

class WorkHandler extends AbstractHandler {

    /**
     * Handles *creator-full-name/work*, *crid/work* and *crid.work* uris
     *
     * Precondition: creator is set on request.
     * @param Request $request
     * @return void
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
                $this->goWorkPage($request, WorkPageControl::MODE_WORK);
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
                $this->goWorkPage($request, WorkPageControl::MODE_CAT);
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
                $this->goWorkPage($request, WorkPageControl::MODE_YEAR);
            }
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
        $this->goWorkPage($request, WorkPageControl::MODE_ID);
    }

    private function goWorkPage(Request $request, int $mode): void {
        $ctrl = new WorkPageControl($request, $mode);
        $ctrl->handleRequest();
        $ctrl->renderPage();
    }


}