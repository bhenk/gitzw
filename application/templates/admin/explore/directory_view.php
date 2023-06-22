<?php
/** @var FileExplorerControl $ctrl */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\FileExplorerControl;

$ctrl = $this;
$ref_url = $ctrl->getLocalReferrerUrl();
$path = $ctrl->getPath();
list($b, $representations, $files) = $ctrl->getDirectoryContents($path);
$bytes = (float)$b;

echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>

<div id="directory_view">

    <h2><a href="<?php echo $ctrl->getBackUrl(); ?>"> &#8678;&nbsp;&nbsp; </a><?php echo $path; ?>
        <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;"
            . count($files) . " files &nbsp;&nbsp;&nbsp;&nbsp; "
            . count($representations) . " representations &nbsp;&nbsp;&nbsp;&nbsp; "
            . round($bytes / 1000 / 1000, 1) . " Mb" ?>
    </h2>

    <div class="representations">
        <?php foreach ($representations as $rep) { ?>
            <a href="/admin/representation/edit/<?php echo $rep->getREPID() ?>">
                <div class="represent">
                    <img src="<?php echo $rep->getFileLocation(Images::IMG_04) ?>" alt="image">
                </div>
            </a>
        <?php } ?>
    </div>
    <?php // for now:
    if (empty($representations)) {
        foreach ($files as $file) {
            echo "<div>";
//            $image = \bhenk\gitzw\base\Env::dataDir() . "/images/phone/" . $file;
//            $ext = pathinfo($image)["extension"];
//            $imgContent = file_get_contents($image);
//            echo '<img src="data:image/' . $ext . ';charset=utf8;base64,' . base64_encode($imgContent) . '" width="200px">';
            echo "<div>$file</div>";
            echo "</div>";
        }
    } ?>

</div>

