<?php
/** @var FileExplorerControl $page */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\FileExplorerControl;

$page = $this;
$path = $page->getPath();
$result = $page->getDirectoryContents($path);
$bytes = (float) $result[0];
$representations = $result[1];
?>

<div id="directory_view">

    <h2><a href="/admin/explore"> &#8678;&nbsp;&nbsp; </a><?php echo $path; ?>
    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . count($representations) . " files &nbsp;&nbsp;&nbsp;&nbsp; " . round($bytes/1000/1000, 1) . " Mb" ?>
    </h2>

    <div class="representations">
        <?php foreach ($representations as $rep) { ?>
            <div class="represent">
                <img src="<?php echo $rep->getFileLocation(Images::IMG_04) ?>" alt="image">
            </div>
        <?php } ?>
    </div>
</div>

