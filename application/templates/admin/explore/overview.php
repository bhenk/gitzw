<?php
/** @var FileExplorerControl $ctrl */

use bhenk\gitzw\ctrla\FileExplorerControl;

$ctrl = $this;
$dirs = $ctrl->getImageDirectories();
$fc = 0;
$dc = 0;
$bc = 0;

$repids = $ctrl->getREPIDS();
$img_names = $ctrl->getImageNames();
echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>

<div id="overview_page">
    <h2>File explorer</h2>
    <div id="columns">

        <div id="directories">
            <span class="col_head">images</span>
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
                        <span class="span2"><?php echo round($counts[2] / 1000 / 1000, 1); ?></span>
                        <a href="<?php echo "/admin/file/explore/$dir"; ?>"><?php echo $dir; ?></a>
                    </div>
                <?php } ?>
                <div>
                    <span class="span1"><?php echo $dc; ?></span>
                    <span class="span1"><?php echo $fc; ?></span>
                    <span class="span2"><?php echo round($bc / 1000 / 1000, 1); ?></span>
                </div>
            </div>
        </div>

        <div id="delta">
            <span class="col_head">images &Delta; representations</span>
            <div class="deltas">
                <span>representations not in images</span>
                <?php $diff = array_diff($repids, $img_names);
                foreach ($diff as $repid) { ?>
                    <div><a href=""><?php echo $repid; ?></a></div>
                <?php } ?>
                <div>Total: <?php echo count($diff); ?></div>
            </div>
            <div class="deltas">
                <span>images not in representations</span>
                <?php $diff = array_diff($img_names, $repids);
                foreach ($diff as $name) { ?>
                    <div><a href=""><?php echo $name; ?></a></div>
                <?php } ?>
                <div>Total: <?php echo count($diff); ?></div>
            </div>
        </div>
    </div>
</div>
