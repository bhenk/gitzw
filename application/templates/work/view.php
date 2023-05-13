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
    <div class="lrpage-prev" title="to the future">
        <a href="<?php echo $page->getFutureUrl(); ?>">
            <picture>
                <source srcset="/img/ico/lefttrianglewhite35.png" media="(prefers-color-scheme: dark)">
                <img src="/img/ico/left_triangle35.png" alt="to the future" title="to the future">
            </picture>
        </a>
    </div>
    <div class="lrpage-next" title="to the past">
        <a href="<?php echo $page->getPastUrl(); ?>">
            <picture>
                <source srcset="/img/ico/righttrianglewhite35.png" media="(prefers-color-scheme: dark)">
                <img src="/img/ico/right_triangle35.png" alt="to the past" title="to the past">
            </picture>
        </a>
    </div>
    <div id="left_menu_in" onclick="leftMenuIn()">
        <img src="/img/ico/left_arrow35.png" alt="hide menu" title="hide menu">
    </div>
    <div id="right_data_in" onclick="rightDataIn()">
        <img src="/img/ico/right_arrow35.png" alt="hide data" title="hide data panel">
    </div>
    <div id="fullscreen" onclick="openFullscreen()">
        <picture>
            <source srcset="/img/ico/fullscreen-white35.png" media="(prefers-color-scheme: dark)">
            <img src="/img/ico/fullscreen-35.png" alt="open fullscreen" title="open fullscreen">
        </picture>
    </div>
</div>

<div id="left_menu_out" onclick="leftMenuOut()">
    <img src="/img/ico/right_arrow35.png" alt="show menu" title="show menu">
</div>

<div id="right_data_out" onclick="rightDataOut()">
    <img src="/img/ico/left_arrow35.png" alt="show data" title="show data panel">
</div>

<!-- zoom in, zoom out-->
<script>
    window.addEventListener("DOMContentLoaded", () => {
        let right_data = getCookie("r_data");
        if (right_data === "out") {
            rightDataOut();
        } else {
            rightDataIn();
        }
    });

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

    function rightDataOut() {
        document.getElementById("column_3").style.display = "inherit";
        document.getElementById("right_data_out").style.display = "none";
        document.getElementById("right_data_in").style.display = "inherit";
        setCookie("r_data", "out", 1);
    }

    function rightDataIn() {
        document.getElementById("column_3").style.display = "none";
        document.getElementById("right_data_out").style.display = "inherit";
        document.getElementById("right_data_in").style.display = "none";
        setCookie("r_data", "in", 1);
    }

    function openFullscreen() {
        let elem = document.getElementById("img_work_view");
        if (elem.requestFullscreen) {
            elem.requestFullscreen().then(r => {});
        }
        elem.style.cursor = "default";
    }
</script>



