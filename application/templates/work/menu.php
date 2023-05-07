<?php
/** @var Menu2d $menu */

use bhenk\gitzw\site\Menu2d;

$menu = $this->getMenu();
?>

<div class="menu_block">
    <?php foreach ($menu->getMenuLabels() as $menu_label) { ?>
    <div class="menu_head">
        <div id="<?php echo $menu_label->getId(); ?>" class="menu_label" onclick="menu_label_click(this)">
            <?php echo $menu_label->getLabel(); ?>
        </div>
        <ul class="menu_items">
            <?php foreach ($menu_label->getItems() as $item) { ?>
            <li class="menu_item"><a <?php if ($item->isActive()) echo "class='selected'"; ?>
                    href="<?php echo $item->getHref(); ?>"><?php echo $item->getLabel(); ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>

<script>
    window.addEventListener("load", () => {
        const elem = document.getElementById("<?php echo $menu->getActiveMenuId(); ?>");
        menu_label_click(elem);
    });
    function menu_label_click(el) {
        const collection = document.getElementsByClassName("menu_label");
        for (let i = 0; i < collection.length; i++) {
            if (collection[i] === el) {
                collection[i].style.outline = "gray 1px solid";
                collection[i].setAttribute("class", "menu_label active")
                collection[i].nextElementSibling.style.display="flex";
            } else if (collection[i].id !== "<?php echo $menu->getActiveMenuId(); ?>") {
                collection[i].style.outline = "";
                collection[i].setAttribute("class", "menu_label")
                collection[i].nextElementSibling.style.display="none";
            }
        }
    }
</script>