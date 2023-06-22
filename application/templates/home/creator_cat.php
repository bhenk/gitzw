<?php

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\CreatorWorkControl;

/** @var CreatorWorkControl $ctrl */
$ctrl = $this;
$creator = $ctrl->getCreator();
$imageData = $ctrl->getCatData();
$years = $ctrl->getCatYears();
?>

<div id="name_container">
    <div>
        <div>
            <a href="<?php echo "/" . $creator->getUriName(); ?>">
                <?php echo $creator->getShortCRID(); ?>
            </a> /
            <a href="<?php echo "/" . $creator->getUriName() . "/work"; ?>">
            work</a> / <?php echo $ctrl->getCategory()->name ?></div>
    </div>
</div>

<div id="cars_container">
    <div class="car_block" id="block_view">
        <div id="year_block_left">
            <?php foreach($years as $year => $url) { ?>
            <a href="<?php echo $url; ?>">
                <div class="year_name"><?php echo $year; ?></div>
            </a>
            <?php } ?>
        </div>
        <div class="image_block">
            <div class="img_car" id="car_view">
                <?php
                $x = count($imageData["resids"]) - 6;
                for ($i = $x; $i < count($imageData["resids"]); $i++) {
                    ?>
                    <div class="image">
                        <a href="<?php echo $imageData['urls'][$i]; ?>">
                            <img src="<?php echo $imageData['images'][$i]; ?>" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="image_sub" id="subscript">
                ----
            </div>
            <div id="year_block_below">
                <?php foreach($years as $year => $url) { ?>
                    <a href="<?php echo $url; ?>">
                        <div class="year_name"><?php echo $year; ?></div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div id="panel">
    <?php require_once Env::templatesDir() . "/base/logo_small.php" ?>
</div>

<script>
    const id = "car_view";
    const images = [<?php echo "'" . implode("', '", $imageData["images"]) . "'"; ?>];
    const years = [<?php echo "'" . implode("', '", $imageData["years"]) . "'"; ?>];
    const titles = [<?php echo "'" . implode("', '", $imageData["titles"]) . "'"; ?>];
    const urls = [<?php echo "'" . implode("', '", $imageData["urls"]) . "'"; ?>];
    let pointer = 0;
    const times = [2000, 3000, 6300];
    let or_hor = false;

    window.addEventListener("load", function () {
        detectOrientation();
        if (or_hor) {
            let car = document.getElementById(id);
            let coll = car.children;
            coll[4].firstElementChild.firstElementChild.style.filter = "blur(20px)";
            coll[5].firstElementChild.firstElementChild.style.filter = "blur(20px)";
        }
        setTimeout(loadNew, 1000);
        const element = document.getElementById("subscript");
        element.scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
    });

    function detectOrientation() {
        try {
            switch (screen.orientation.type) {
                case "landscape-primary":
                case "landscape-secondary":
                    or_hor = true;
                    break;
                case "portrait-secondary":
                case "portrait-primary":
                    or_hor = false;
                    break;
                default:
                    or_hor = false;
            }
        } catch (error) {
            console.error(error);
        }

    }

    function loadNew() {
        detectOrientation();
        let image = images[pointer];
        let url = urls[pointer];
        let to = times[0];

        pointer++;
        if (pointer >= images.length) pointer = 0;

        let car = document.getElementById(id);
        let img_div = document.createElement("div");
        img_div.className = "image";
        img_div.innerHTML = '<a href="' + url + '"><img src="' + image + '" alt=""></a>';
        if (or_hor) {
            img_div.firstElementChild.firstElementChild.style.filter = "blur(20px)";
        }
        car.appendChild(img_div);
        setTimeout(moveAndBlur, to);
    }

    function moveAndBlur() {
        let to = times[1];

        let car = document.getElementById(id);
        car.nextElementSibling.innerText = "...";
        car.firstElementChild.style.width = "0";
        let coll = car.children;
        coll[4].firstElementChild.firstElementChild.style.filter = "blur(0)";
        if (or_hor) {
            coll[3].firstElementChild.firstElementChild.style.filter = "blur(20px)";
        } else {
            for (let i = 0; i < coll.length; i++) {
                coll[i].firstElementChild.firstElementChild.style.filter = "blur(0)";
            }
        }

        let year = years[pointer];
        let lb = document.getElementById("year_block_left");
        let bb = document.getElementById("year_block_below");
        let l_coll = lb.children;
        let b_coll = bb.children;
        for (let i=0; i < l_coll.length; i++) {
            if (l_coll[i].firstElementChild.innerText === year) {
                l_coll[i].firstElementChild.className = "year_accent";
                b_coll[i].firstElementChild.className = "year_accent";
            } else {
                l_coll[i].firstElementChild.className = "year_name";
                b_coll[i].firstElementChild.className = "year_name";
            }
        }

        setTimeout(unload, to);
    }

    function unload() {
        let to = times[2];
        let title = titles[pointer];
        let car = document.getElementById(id);
        car.nextElementSibling.innerText = title;
        car.removeChild(car.firstElementChild);
        setTimeout(loadNew, to);
    }


</script>
