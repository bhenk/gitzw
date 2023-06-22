<?php

use bhenk\gitzw\dajson\Registry;

$registry = Registry::actionRegistry();
echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>

<div id="admin_page">
    <div id="actions">
        <h1>Actions</h1>
        <div class="info_block">
            <?php foreach ($registry->getActions() as $action) { ?>
                <div class="info_head">
                    <span><?php echo $action->getACID(); ?></span><span><?php echo $action->getName(); ?></span>
                </div>
                <div class="info_row">
                    <label>Last modified:</label>
                    <span><?php echo $action->getLastModifiedToString(); ?></span>
                    <span><a href="<?php echo $action->getPath(); ?>"><?php echo $action->getLocation() ?></a></span>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="statistics">
        <h1>Stats</h1>
        <div class="info_block">
            <div class="info_head">
                <span>STORE</span><span></span>
            </div>
            <div class="info_row">
                <label>Voorlopig:</label>
                <span></span>
                <span><a href="/henk-van-den-berg/work/painting/2022/0000">Into the forest</a></span>
            </div>
        </div>
    </div>
</div>
