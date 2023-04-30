<?php
$menu = $this->getSiteMenu();
?>
<div id="site_menu">
    <ul class="menu-list">
        <?php foreach ($menu->getItems() as $item) { ?>
            <li class="menu-item"><a class="<?php echo $item->getClass(); ?>"
                   href="<?php echo $item->getHref(); ?>">
                    <?php echo $item->getLabel(); ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>
