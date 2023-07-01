<?php

use bhenk\gitzw\dajson\Registry;
use bhenk\gitzw\dao\Dao;

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
        <?php
        try {
            $result = Dao::workDao()->selectBatch([1, 2, 4]);
            foreach ($result as $row) {
                echo "<div>" . var_export($row->getRESID(), true) . "</div>";
            }
        } catch (Exception $e) {
            if (!is_null($e)) {
                do {
                    echo "<h2>" . $e::class . "</h2>" . $e->getMessage() . "<hr/>";
                    echo $e->getFile() . ":" . $e->getLine() . "<br/>"
                        . str_replace("\n", "<br/>", $e->getTraceAsString());
                    $e = $e->getPrevious();
                } while (!is_null($e));
            }
        }
        ?>
    </div>
</div>
