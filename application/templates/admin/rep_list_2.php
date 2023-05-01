<?php
$rep_list = $this->getRepresentations();
?>

<div id="admin_rep_list_2">
    <div>
        <span class="statistics"><?php echo $this->getSourceCount(); ?></span>
    </div>
    <?php foreach ($rep_list as $rep) { ?>
    <div class="representation">
        <span><?php echo $rep->getREPID(); ?></span><br/>
        <span><?php echo $rep->getsource(); ?></span><br/>
        <span><?php echo $rep->getFilename(); ?></span><br/>
        <hr>
    </div>
    <?php } ?>
</div>

