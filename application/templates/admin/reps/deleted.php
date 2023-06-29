<?php
/** @var RepEditControl $ctrl */

use bhenk\gitzw\ctrla\RepEditControl;

$ctrl = $this;
echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>

<div id="delete_page">
    <h2>Delete REPID <?php echo $ctrl->getRepresentation()->getREPID() ?></h2>
    <?php if (!empty($ctrl->getErrors())) {
        echo "<div class='errors'>";
        foreach ($ctrl->getErrors() as $msg) {
            echo "<div>" . $msg . "</div>";
        }
        echo "</div>";
    } ?>
    <?php if (!empty($ctrl->getMessages())) {
        echo "<div class='messages'>";
        foreach ($ctrl->getMessages() as $msg) {
            echo "<div>" . $msg . "</div>";
        }
        echo "</div>";
    } ?>
</div>
