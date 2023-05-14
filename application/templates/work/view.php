<?php

/** @var WorkViewControl $page */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrl\WorkViewControl;

$page = $this;
$work = $page->getWork();
$repr = $work->getRelations()->getPreferredRepresentation();
$location_30 = $repr->getLocation(Images::IMG_30);
$location_15 = $repr->getLocation(Images::IMG_15);
$location_08 = $repr->getLocation(Images::IMG_08);
?>

<div id="work_view">
    <div class="work">
        <picture class="image">
            <source srcset="<?php echo $location_08 ?>" media="(max-width: 600px)">
            <source srcset="<?php echo $location_15 ?>" media="(max-width: 1000px)">
            <img id="img_work_view" class="ani" src="<?php echo $location_30; ?>" alt="<?php echo $work->getRESID(); ?>"
                 onclick="image_clicked(this)">
        </picture>
        <span><?php echo $work->getTitles("&lt;no title&gt;")
                . " - " . $work->getMedia() . " - " . $work->getDimensions(); ?></span>
    </div>
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
    <a href="<?php echo $page->getFutureUrl(); ?>">
        <picture class="glower" id="future_link"  onmouseover="futureLinkOver()" onmouseout="futureLinkOut()">
            <source srcset="/img/ico/lefttrianglewhite35.png" media="(prefers-color-scheme: dark)">
            <img src="/img/ico/left_triangle35.png" alt="to the future" title="to the future">
        </picture>
    </a>
    <picture onclick="openFullscreen()" class="glower">
        <source srcset="/img/ico/fullscreen-w35.png" media="(prefers-color-scheme: dark)">
        <img src="/img/ico/fullscreen-35.png" alt="open fullscreen" title="open fullscreen">
    </picture>
    <a href="<?php echo $page->getFutureUrl(); ?>" title="to the future">
        <div class="link_bar" onmouseover="futureLinkOver()" onmouseout="futureLinkOut()"></div>
    </a>
</div>

<div id="right_button_group">
    <picture onclick="rightDataIn()" class="glower" id="right_in">
        <source srcset="/img/ico/right-arrow-w35.png" media="(prefers-color-scheme: dark)">
        <img src="/img/ico/right-arrow-b35.png" alt="hide data panel" title="hide data panel">
    </picture>
    <picture onclick="rightDataOut()" class="glower" id="right_out">
        <source srcset="/img/ico/left-arrow-w35.png" media="(prefers-color-scheme: dark)">
        <img src="/img/ico/left-arrow-b35.png" alt="show data panel" title="show data panel">
    </picture>
    <a href="<?php echo $page->getPastUrl(); ?>">
        <picture class="glower" id="past_link" onmouseover="pastLinkOver()" onmouseout="pastLinkOut()">
            <source srcset="/img/ico/righttrianglewhite35.png" media="(prefers-color-scheme: dark)">
            <img src="/img/ico/right_triangle35.png" alt="to the future" title="to the past">
        </picture>
    </a>
    <a href="<?php echo $page->getPastUrl(); ?>" title="to the past">
        <div class="link_bar" onmouseover="pastLinkOver()" onmouseout="pastLinkOut()"></div>
    </a>
</div>

<script>
    window.addEventListener("DOMContentLoaded", () => {

        let left_menu = getCookie("l_menu");
        if (left_menu === "in") {
            document.getElementById("column_1").style.display = "none";
            leftMenuIn();
        } else {
            leftMenuOut();
        }
        let right_data = getCookie("r_data");
        if (right_data === "out") {
            rightDataOut();
        } else {
            rightDataIn();
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

    function rightDataOut() {
        document.getElementById("column_3").style.display = "inherit";
        document.getElementById("right_button_group").style.right ="var(--col3width)";
        document.getElementById("right_out").style.display = "none";
        document.getElementById("right_in").style.display = "inherit";
        setCookie("r_data", "out", 1);
    }

    function rightDataIn() {
        document.getElementById("column_3").style.display = "none";
        document.getElementById("right_button_group").style.right ="0";
        document.getElementById("right_out").style.display = "inherit";
        document.getElementById("right_in").style.display = "none";
        setCookie("r_data", "in", 1);
    }

    function futureLinkOver() {
        document.getElementById("future_link").style.opacity = "1.0";
    }

    function futureLinkOut() {
        document.getElementById("future_link").style.opacity = "var(--opacity)";
    }

    function pastLinkOver() {
        document.getElementById("past_link").style.opacity = "1.0";
    }

    function pastLinkOut() {
        document.getElementById("past_link").style.opacity = "var(--opacity)";
    }

    function image_clicked(el) {
        if (document.fullscreenElement) {
            document.exitFullscreen();
            el.style.maxHeight = "calc(100vh - 100px)";
            el.style.cursor = "zoom-in";
        } else {
            let style = el.style.maxHeight;
            if (style === "100%") {
                el.style.maxHeight = "calc(100vh - 100px)";
                el.style.cursor = "zoom-in";
            } else {
                el.style.maxHeight = "100%";
                el.style.cursor = "zoom-out";
            }
        }
    }

    function openFullscreen() {
        let elem = document.getElementById("img_work_view");
        if (elem.requestFullscreen) {
            elem.requestFullscreen().then(function (r) {
            });
        }
        elem.style.cursor = "default";
    }

    function sleep(milliseconds) {
        const date = Date.now();
        let currentDate = null;
        do {
            currentDate = Date.now();
        } while (currentDate - date < milliseconds);
    }
</script>



