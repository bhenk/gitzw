<?php
/** @var RepExplorerControl $ctrl */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\RepExplorerControl;

$ctrl = $this;

echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>
<div id="year_view">
    <h2><a href="/admin/representation/explore"> &#8678;&nbsp;&nbsp; </a>
        <?php echo $ctrl->getCrYear();
            echo " &nbsp;&nbsp;&nbsp;&nbsp; " . $ctrl->getViewFilter();
            echo " &nbsp;&nbsp;&nbsp;&nbsp; " . count($ctrl->getRepresentations()) . " representations"
        ?></h2>

    <div class="representations">
        <?php foreach ($ctrl->getRepresentations() as $rep) { ?>
            <a href="/admin/representation/edit/<?php echo $rep->getREPID() ?>">
                <div class="represent">
                    <img src="<?php echo $rep->getFileLocation(Images::IMG_04) ?>" alt="image">
                </div>
            </a>
        <?php } ?>
    </div>
</div>
