<?php

use bhenk\gitzw\base\Env;

$dir = Env::public_html() . "/uploads";
$files = array_diff(scandir($dir), array('..', '.'));
$count = 0;
?>

<div id="upload_area">
    <h2>Upload files</h2>

    <form id="upload" action="/admin/upload" method="post" enctype="multipart/form-data">
        <input type="file" id="fileToUpload" name="the_files[]" multiple="multiple">
        <div>
            <input type="hidden" name="action" value="upload">
            <input type="reset" name="cancel" value="Cancel"">
            <input type="submit" value="Upload" name="submit">
        </div>
    </form>

    <h2>Uploaded <?php echo count($files) ?></h2>

    <?php if (!empty($files)) { ?>
    <form id="uploaded" action="/admin/upload" method="post">
        <div class="img_uploads">
            <?php foreach ($files as $name) {
                $src_name = "/uploads/$name";
                $stat = stat("$dir/$name");
                $type = mime_content_type("$dir/$name");
                $size = $stat["size"] > 1000000 ? round($stat["size"] / 1000 / 1000, 1)
                    . " Mb" : round($stat["size"] / 1000, 1) . " kb";;
                ?>
                <div onclick="toggleSelect('<?php echo 's_' . $name; ?>')">
                    <?php if (getimagesize("$dir/$name")) { ?>
                        <img src="<?php echo $src_name; ?>" alt="<?php echo $name; ?>">
                    <?php } else { ?>
                        <div class="placeholder">&#9778;</div>
                    <?php } ?>
                    <div><?php echo $name; ?></div>
                    <div><?php echo $type; ?></div>
                    <div><?php echo $size; ?></div>
                    <div><?php echo date("Y-m-d H:i:s", $stat["mtime"]); ?></div>
                    <div>
                        <input type="checkbox" id="<?php echo "s_$name"; ?>" name="<?php echo "file_" . $count++; ?>">
                        <label for="<?php echo "s_$name"; ?>"> </label>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="button_panel">
            <input type="hidden" name="action" value="uploaded">
            <input type="button" name="selectAll" value="select all" onclick="toggleAll(true)">
            <input type="button" name="deselectAll" value="deselect all" onclick="toggleAll(false)">
            <input type="submit" name="deleteSelected" value="delete selected">
            <input type="submit" name="moveSelected" value="move selected">
        </div>
    </form>
    <?php } ?>
</div>

<script>
    function toggleSelect(id) {
        let cb = document.getElementById(id);
        cb.checked = !cb.checked;
    }

    function toggleAll(bool) {
        let els = document.querySelectorAll("input[type=checkbox]")
        for (let i=0; i < els.length; i++) {
            els[i].checked = bool;
        }
    }
</script>