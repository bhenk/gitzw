<!DOCTYPE html>
<html lang="en">
<?php
include("head.php");
?>
<body>
<?php if ($this->includeHeader()) { ?>
    <div id="header">
        <?php $this->renderHeader(); ?>
    </div>
<?php } ?>
<?php if ($this->includeContainer()) { ?>
<div id="container">
    <?php if ($this->includeColumn1()) { ?>
        <div id="column_1">
            <div id="c1_content">
            <?php $this->renderColumn1(); ?>
            </div>
        </div>
    <?php } ?>
    <?php if ($this->includeColumn2()) { ?>
        <div id="column_2">
            <?php $this->renderColumn2(); ?>
        </div>
    <?php } ?>
    <?php if ($this->includeColumn3()) { ?>
        <div id="column_3">
            <?php $this->renderColumn3(); ?>
        </div>
    <?php } ?>
</div>
<?php } else {
    $this->renderBody();
} ?>

</body>
<?php
if ($this->includeFooter()) {
    include("footer.php");
}
?>
</html>
