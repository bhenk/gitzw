<?php

/** @var \bhenk\gitzw\ctrla\RepresentationsPageControl $page */
use bhenk\gitzw\base\Images;

$page = $this;
$rep_list = $page->getRepresentations();
?>
<div id="admin_rep_list_2">
    <?php foreach ($rep_list as $rep) { ?>
    <div class="representation">
        <div>
            <img src="<?php echo $rep->getFileLocation(Images::IMG_04) ?>" alt="image">
        </div>
        <span><?php echo $rep->getREPID(); ?></span><br/>
        <span><?php echo $rep->getsource(); ?></span><br/>
    </div>
    <?php } ?>
</div>

