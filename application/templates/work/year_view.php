<?php

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrl\WorkYearViewControl;
use bhenk\gitzw\dat\Work;

/** @var WorkYearViewControl $page */
$page = $this;
/** @var Work[] $works */
$works = $this->getWorks();

?>
<div id="works_year_view">
    <?php foreach ($works as $work) { ?>
        <div class="work">
            <div class="image">
                <?php
                $representation = $work->getRelations()->getPreferredRepresentation();
                $location = "/img/cow.png";
                if (!is_null($representation)) {
                    $location = $representation->getLocation(Images::IMG_04);
                }
                ?>
                <a href="<?php echo "/" . $work->getCanonicalUrl(); ?>">
                <img src="<?php echo $location; ?>" alt="<?php echo $work->getRESID(); ?>"></a>
                <div><?php echo $work->getTitles("&lt;no title&gt;"); ?></div>
            </div>
        </div>
    <?php } ?>
    <div id="left_menu_in" onclick="leftMenuIn()">
        <img src="/img/ico/left_arrow35.png" alt=">" title="hide menu">
    </div>
</div>
<div class="works_year_btn">
    <a href="<?php echo $page->getUrlPrevious(); ?>">
        <span class="page_btn<?php echo $page->isPreviousEnabled(); ?>"> &#9664; </span>
    </a>
    <span class="page_dig">
        &nbsp;  &nbsp; <?php echo $page->getPage() . " : " . $page->getTotalPages() . " / ". $page->getTotalWorks(); ?>  &nbsp;  &nbsp; </span>
    <a href="<?php echo $page->getUrlNext(); ?>">
        <span class="page_btn<?php echo $page->isNextEnabled(); ?>"> &#9654; </span>
    </a>
</div>

<div id="left_menu_out" onclick="leftMenuOut()">
    <img src="/img/ico/right_arrow35.png" alt=">" title="unhide menu">
</div>

<script>
    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchmove', handleTouchMove, false);

    let xDown = null;
    let yDown = null;

    function getLastPart(url) {
        const parts = url.split('/');
        return parts.at(-1);
    }

    function getTouches(evt) {
        return evt.touches ||             // browser API
            evt.originalEvent.touches; // jQuery
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

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
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
