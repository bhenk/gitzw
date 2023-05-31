<?php

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrla\UploadControl;

/** @var UploadControl $page */
$page = $this;
$files_to_handle = $page->getFilesToHandle();
$options = $page->getDestinationOptions();
?>
<div id="upload_area">

    <h2>Move files</h2>

    <?php include "show_selected_files.php"; ?>

    <form id="move_selected" action="/admin/upload" method="post">
        <label for="dir_select">Destination: </label>
        <select name="dir_select" id="dir_select" onchange="selectionChanged(this)">
            <?php foreach ($options as $option) { ?>
                <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
            <?php } ?>
        </select>
        <label for="path">Directory: </label>
        <input type="text" id="dir_path" name="path" value=""><br/>
        <input type="hidden" name="action" value="moveFiles">
        <input type="hidden" name="files_to_move" value="<?php echo implode(';', $files_to_handle) ?>">
        <div class="move_buttons">
            <input type="submit" name="cancelMove" value="Cancel">
            <input type="submit" name="doMove" value="Move">
        </div>
    </form>
    <?php if (!empty($page->getErrorMsg())) { ?>
        <div class="error"><?php echo $page->getErrorMsg(); ?></div>
    <?php } ?>
</div>

<script>
    function selectionChanged(el) {
        let tag = document.getElementById("dir_path");
        tag.value = el.value;
    }
</script>