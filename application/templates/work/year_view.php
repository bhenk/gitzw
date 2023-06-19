<?php

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrl\WorkYearViewControl;
use bhenk\gitzw\dat\Work;

/** @var WorkYearViewControl $page */
$page = $this;
$creator = $page->getRequest()->getCreator();
$category = $page->getRequest()->getWorkCategory();
$year = $page->getRequest()->getUrlPart(3);
/** @var Work[] $works */
$works = $this->getWorks();

?>
<div id="name_container">
    <div>
        <a href="<?php echo "/" . $creator->getUriName(); ?>">
            <?php echo $creator->getShortCRID(); ?>
        </a> /
        <a href="<?php echo "/" . $creator->getUriName() . "/work"; ?>">
            work
        </a> /
        <a href="<?php echo "/" . $creator->getUriName() . "/work/" . $category->value; ?>">
            <?php echo $category->name ?>
        </a> / <?php echo $year ?>
    </div>
</div>
<div id="works_year_view">
    <?php foreach ($works as $work) { ?>
        <div class="work">
            <div class="image">
                <?php
                $representation = $work->getRelations()->getPreferredRepresentation();
                $location = "/img/cow.png";
                if (!is_null($representation)) {
                    $location = $representation->getFileLocation(Images::IMG_04);
                }
                ?>
                <a href="<?php echo "/" . $work->getCanonicalUrl(); ?>">
                <img src="<?php echo $location; ?>" alt="<?php echo $work->getRESID(); ?>"></a>
                <div><?php echo $work->getTitles("&lt;no title&gt;"); ?></div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="works_year_btn">
    <a href="<?php echo $page->getUrlPrevious(); ?>">
        <span class="page_btn<?php echo $page->isPreviousEnabled(); ?>"> &#9664; </span>
    </a>
    <span class="page_dig<?php echo $page->isDigitsEnabled(); ?>">
        &nbsp;  &nbsp; <?php echo $page->getPage() . " : " . $page->getTotalPages() . " / ". $page->getTotalWorks(); ?>  &nbsp;  &nbsp; </span>
    <a href="<?php echo $page->getUrlNext(); ?>">
        <span class="page_btn<?php echo $page->isNextEnabled(); ?>"> &#9654; </span>
    </a>
</div>

<div id="left_button_group">
    <picture onclick="leftMenuIn()" class="glower" id="left_in">
        <source srcset="/img/ico/left-arrow-w35.png" media="(prefers-color-scheme: dark)">
        <img src="/img/ico/left-arrow-b35.png" alt="hide menu" title="hide menu">
    </picture>
    <picture onclick="leftMenuOut()" class="glower" id="left_out">
        <source srcset="/img/ico/right-arrow-w35.png" media="(prefers-color-scheme: dark)">
        <img src="/img/ico/right-arrow-b35.png" alt="hide menu" title="show menu">
    </picture>
</div>

<script>
    window.addEventListener("DOMContentLoaded", () => {

        let left_menu = getCookie("l_menu");
        if (left_menu === "in" && window.innerWidth > 1000) {
            document.getElementById("column_1").style.display = "none";
            leftMenuIn();
        } else {
            leftMenuOut();
        }
    });

    function leftMenuOut() {
        document.getElementById("column_1").style.display = "inherit";
        document.getElementById("c1_content").style.opacity = "1.0";
        document.getElementById("left_button_group").style.left ="var(--col1width)";
        document.getElementById("left_out").style.display = "none";
        document.getElementById("left_in").style.display = "inherit";
        setCookie("l_menu", "out", 1);
        document.getElementById("c1_content").ontransitionend = function () {
            let opa = document.getElementById("c1_content").style.opacity;
            if (opa === "0") {
                document.getElementById("column_1").style.display = "none";
            }
        };
    }

    function leftMenuIn() {
        document.getElementById("c1_content").style.opacity = "0.0";
        document.getElementById("left_button_group").style.left ="0";
        document.getElementById("left_out").style.display = "inherit";
        document.getElementById("left_in").style.display = "none";
        setCookie("l_menu", "in", 1);
    }


    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchmove', handleTouchMove, false);

    let xDown = null;
    let yDown = null;

    function getLastPart(url) {
        const parts = url.split('/');
        return parts.at(-1);
    }

    function getTouches(evt) {
        return evt.touches || evt.originalEvent.touches;
    }

    function handleTouchStart(evt) {
        const firstTouch = getTouches(evt)[0];
        xDown = firstTouch.clientX;
        yDown = firstTouch.clientY;
    }

    function handleTouchMove(evt) {
        if ( ! xDown || ! yDown ) {
            return;
        }

        let xUp = evt.touches[0].clientX;
        let yUp = evt.touches[0].clientY;

        let xDiff = xDown - xUp;
        let yDiff = yDown - yUp;

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
            /*document.getElementById("grey_space").style.display = "inherit"*/
            if ( xDiff > 0 ) {
                /* right swipe */
                if (window.location.href.includes("view")) {
                    window.location = "swipe_right";
                } else {
                    window.location = getLastPart(window.location.href) + "/view/swipe_right";
                }
            } else {
                /* left swipe */
                if (window.location.href.includes("view")) {
                    window.location = "swipe_left";
                } else {
                    window.location = getLastPart(window.location.href) + "/view/swipe_left";
                }
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    }

</script>
