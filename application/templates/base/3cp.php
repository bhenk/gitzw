<?php
include("header.php");
?>
<body>
    <div class="head">
        <?php $this->renderHead(); ?>
    </div>
    <div id="container">
        <div id="column_1">
            <?php $this->renderColumn_1(); ?>
        </div>
        <div id="column_2">
            <img class="ani" src="img/DSC02096.jpeg" alt="bla">
                <?php $this->renderColumn_2(); ?>

        </div>
        <div id="column_3">
                <?php $this->renderColumn_3(); ?>
        </div>
    </div>
</body>
<?php
include("footer.php");
?>
