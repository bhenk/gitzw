<?php
/** @var RepsControl $ctrl */

use bhenk\gitzw\ctrla\RepsControl;

$ctrl = $this;
$countByYear = $ctrl->getCountByYear();
?>
<div id="overview_page">

    <h2>Representation explorer</h2>
    <div id="columns">
        <div id="repids">
            <span class="col_head">REPIDs by year</span>
            <div class="listing">
                <div>
                    <span class="span1">count</span>
                    <span>crid year</span>
                </div>
                <?php foreach($countByYear as $rep_year => $count) { ?>
                <div>
                    <span class="span1"><?php echo $count; ?></span>
                    <a href="/admin/explore/images/<?php echo $rep_year; ?>"><?php echo $rep_year ?></a>
                </div>
                <?php } ?>
                <div>
                    <span class="span1"><?php echo array_sum($countByYear) ?></span>
                    <span>representations</span>
                </div>
            </div>
        </div>
    </div>
</div>
