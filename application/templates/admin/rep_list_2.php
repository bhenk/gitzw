<?php

use bhenk\gitzw\base\Images;

$rep_list = $this->getRepresentations();
?>

<div id="admin_rep_list_2">
    <?php foreach ($rep_list as $rep) { ?>
    <div class="representation">
        <div>
            <img src="<?php echo $rep->getLocation(Images::SMALLER) ?>" alt="image">
        </div>
        <span><?php echo $rep->getREPID(); ?></span><br/>
        <span><?php echo $rep->getsource(); ?></span><br/>
    </div>
    <?php } ?>
</div>

