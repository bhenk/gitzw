<?php
/** @var FileExplorerControl $ctrl */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\FileExplorerControl;

$ctrl = $this;
$path = $ctrl->getPath();
list($b, $representations) = $ctrl->getDirectoryContents($path);
$bytes = (float)$b;
?>

<div id="directory_view">

    <h2><a href="/admin/explore"> &#8678;&nbsp;&nbsp; </a><?php echo $path; ?>
        <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"
            . count($representations) . " files &nbsp;&nbsp;&nbsp;&nbsp; "
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
</div>

