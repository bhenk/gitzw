<?php
/** @var FileExplorerControl $ctrl */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\FileExplorerControl;

$ctrl = $this;
$ref_url = $ctrl->getLocalReferrerUrl();
$path = $ctrl->getPath();
list($b, $representations, $files) = $ctrl->getDirectoryContents($path);
$bytes = (float)$b;
?>

<div id="directory_view">

    <h2><a href="<?php echo $ref_url; ?>"> &#8678;&nbsp;&nbsp; </a><?php echo $path; ?>
        <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"
            . count($files) . " files &nbsp;&nbsp;&nbsp;&nbsp; "
            . count($representations) . " representations &nbsp;&nbsp;&nbsp;&nbsp; "
            . round($bytes / 1000 / 1000, 1) . " Mb" ?>
    </h2>

    <div class="representations">
        <?php foreach ($representations as $rep) { ?>
            <a href="/admin/image/<?php echo $rep->getREPID() ?>">
                <div class="represent">
                    <img src="<?php echo $rep->getFileLocation(Images::IMG_04) ?>" alt="image">
                </div>
            </a>
        <?php } ?>
    </div>
    <?php // for now:
    if (empty($representations)) {
        foreach ($files as $file) {
            echo "<div>$file</div>";
        }
    } ?>
</div>

