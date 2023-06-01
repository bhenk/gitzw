<?php

use bhenk\gitzw\ctrla\UploadControl;

/** @var UploadControl $ctrl */
$ctrl = $this;
$files_to_handle = $ctrl->getFilesToHandle();
?>

<div id="upload_area">
    <h2>Confirm delete</h2>

    <form id="confirm_delete" action="/admin/upload" method="post">
        <?php include "show_selected_files.php"; ?>
        <div class="button_panel">
            <input type="hidden" name="action" value="confirmDelete">
            <input type="hidden" name="files_to_delete" value="<?php echo implode(';', $files_to_handle) ?>">
            <input type="submit" name="cancelDelete" value="Cancel">
            <input type="submit" name="doDelete" value="Delete">
        </div>
    </form>
</div>
