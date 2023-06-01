<?php
/** @var FileExplorerControl $ctrl */

use bhenk\gitzw\ctrla\FileExplorerControl;

$ctrl = $this;
$dirs = $ctrl->getImageDirectories();
$fc = 0;
$dc = 0;
$bc = 0;
?>

<div id="overview_page">
    <h2>File explorer</h2>
    images
    <div class="directories">
        <div>
            <span class="span1">D</span>
            <span class="span1">F</span>
            <span class="span2">Mb</span>
            <span class="top_label">directory</span>
        </div>
        <?php foreach ($dirs as $dir => $counts) {
            $dc += $counts[0];
            $fc += $counts[1];
            $bc += $counts[2];
            ?>
            <div>
                <span class="span1"><?php echo $counts[0]; ?></span>
                <span class="span1"><?php echo $counts[1]; ?></span>
                <span class="span2"><?php echo round($counts[2]/1000/1000, 1); ?></span>
                <a href="<?php echo "/admin/explore/$dir"; ?>"><?php echo $dir; ?></a>
            </div>
        <?php } ?>
        <div>
            <span class="span1"><?php echo $dc; ?></span>
            <span class="span1"><?php echo $fc; ?></span>
            <span class="span2"><?php echo round($bc/1000/1000, 1); ?></span>
        </div>
    </div>
</div>
