<?php
/** @var WorkControl $ctrl */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\WorkControl;

$ctrl = $this;
$work = $ctrl->getWork();
$repr = $work->getRelations()->getPreferredRepresentation();
$file_loc = $repr->getFileLocation(Images::IMG_15);
?>

<div id="edit_work">
    <div class="work_panel">
        <div class="work_view">
            <img src="<?php echo $file_loc; ?>" alt="representation">
        </div>
        <div class="work_form">
            <form id="edit_work" name="edit_work" action="/admin/work/create" method="post">
                <h2><a href="#" onclick="history.back()"> &#8678;&nbsp;&nbsp; </a>
                    RESID: <span><?php echo $work->getRESID(); ?></span>
                    <span title="copy RESID" class="copyprevious" onclick="copyPrevious(this)">&nbsp;&#9776; </span>
                </h2>
                <div>ID: <span><?php echo $work->getID() ?? "not created"; ?></span>
                    <span title="copy ID" class="copyprevious" onclick="copyPrevious(this)">&nbsp;&#9776; </span>
                </div>
                <hr/>
                <div class="form_rows">
                    <div class="form_row">
                        <label class="fm_label" for="creator">Creator: </label>
                        <span id="creator"><?php echo $work->getCreator()->getFullName(); ?></span>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="category">Category: </label>
                        <span id="category"><?php echo $work->getCategory()->value; ?></span>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="date">Date: </label>
                        <span id="date"><?php echo $work->getDate(); ?></span>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="repid">REPID: </label>
                        <span id="repid"><?php echo $repr->getREPID(); ?></span>
                    </div>
                    <div class="button_row">
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="resid" value="<?php echo $work->getRESID(); ?>">
                        <input type="hidden" name="crid" value="<?php echo $work->getCreator()->getCRID(); ?>">
                        <input type="hidden" name="category" value="<?php echo $work->getCategory()->name; ?>">
                        <input type="hidden" name="date" value="<?php echo $work->getDate(); ?>">
                        <input type="hidden" name="repid" value="<?php echo $repr->getREPID() ?>">
                        <input type="submit" id="submit" value="Create" name="submit">
                    </div>
                </div>
                <hr/>
            </form>
        </div>
    </div>
</div>
