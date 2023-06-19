<?php

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\CreatorWorkControl;
use bhenk\gitzw\model\WorkCategories;

/** @var CreatorWorkControl $ctrl */
$ctrl = $this;
$categories = [WorkCategories::paint, WorkCategories::draw, WorkCategories::dry];
$creator = $ctrl->getCreator();
$data = $ctrl->getData();
?>

<div id="name_container">
    <div>
        <div><?php echo $creator->getShortCRID(); ?> / work</div>
    </div>
</div>

<div id="cars_container">

    <?php foreach ($categories as $cat) { ?>
        <div class="car_block" id="block_<?php echo $cat->name ?>">
            <a href="/<?php echo $creator->getUriName() . "/work/" . $cat->value; ?>">
                <div class="cat_name"><?php echo $cat->name ?></div>
            </a>
            <div class="image_block">
                <div class="img_car" id="car_<?php echo $cat->name; ?>">
                    <?php
                    $imageData = $data[$cat->name];
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
                <div class="image_sub">
                    ----
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<div id="panel">
    <?php require_once Env::templatesDir() . "/base/logo_small.php" ?>
</div>

<script>
    const ids = ["car_paint", "car_draw", "car_dry"];
    const images = [
        [<?php echo "'" . implode("', '", $data["paint"]["images"]) . "'"; ?>],
        [<?php echo "'" . implode("', '", $data["draw"]["images"]) . "'"; ?>],
        [<?php echo "'" . implode("', '", $data["dry"]["images"]) . "'"; ?>]
    ];
    const titles = [
        [<?php echo "'" . implode("', '", $data["paint"]["titles"]) . "'"; ?>],
        [<?php echo "'" . implode("', '", $data["draw"]["titles"]) . "'"; ?>],
        [<?php echo "'" . implode("', '", $data["dry"]["titles"]) . "'"; ?>]
    ];
    const urls = [
        [<?php echo "'" . implode("', '", $data["paint"]["urls"]) . "'"; ?>],
        [<?php echo "'" . implode("', '", $data["draw"]["urls"]) . "'"; ?>],
        [<?php echo "'" . implode("', '", $data["dry"]["urls"]) . "'"; ?>]
    ];
    const pointers = [0, 0, 0];
    const times = [
        [2000, 3000, 6300],
        [2000, 3000, 7400],
        [2000, 3000, 8200]
    ];

    window.addEventListener("load", function () {
        setTimeout(loadNew, 1000, 2);
        setTimeout(loadNew, 1100, 1);
        setTimeout(loadNew, 1200, 0);
    });

    function loadNew(index) {
        let id = ids[index];
        let imgs = images[index];
        let links = urls[index];
        let pointer = pointers[index];
        let image = imgs[pointer];
        let url = links[pointer];
        let tos = times[index];
        let to = tos[0];

        pointer++;
        if (pointer >= imgs.length) pointer = 0;
        pointers[index] = pointer;

        let car = document.getElementById(id);
        let img_div = document.createElement("div");
        img_div.className = "image";
        img_div.innerHTML = '<a href="' + url + '"><img src="' + image + '" alt=""></a>';
        img_div.firstElementChild.firstElementChild.style.filter = "blur(20px)";
        car.appendChild(img_div);
        setTimeout(moveAndBlur, to, index);
    }

    function moveAndBlur(index) {
        let id = ids[index];
        let tos = times[index];
        let to = tos[1];

        let car = document.getElementById(id);
        car.nextElementSibling.innerText = "...";
        car.firstElementChild.style.width = "0";
        let coll = car.children;
        coll[2].firstElementChild.firstElementChild.style.filter = "blur(20px)";
        coll[5].firstElementChild.firstElementChild.style.filter = "blur(0)";
        setTimeout(unload, to, index);
    }

    function unload(index) {
        let id = ids[index];
        let tos = times[index];
        let to = tos[2];
        let tls = titles[index];
        let pointer = pointers[index];
        let title = tls[pointer];
        let car = document.getElementById(id);
        car.nextElementSibling.innerText = title;
        car.removeChild(car.firstElementChild);
        setTimeout(loadNew, to, index);
    }


</script>
