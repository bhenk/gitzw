<?php
use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrla\UploadControl;

/** @var UploadControl $ctrl */
$ctrl = $this;
$dir = Env::public_html() . "/uploads";
$files = array_values(array_diff(scandir($dir), array('..', '.')));

$files_to_handle = $ctrl->getFilesToHandle();
?>

<div class="img_uploads">
    <?php for($i=0; $i < count($files); $i++) {
        if (in_array($i, $files_to_handle)) {
            $src_name = "/uploads/" . $files[$i];
            $stat = stat("$dir/$files[$i]");
            $type = mime_content_type("$dir/$files[$i]");
            $size = $stat["size"] > 1000000 ? round($stat["size"] / 1000 / 1000, 1)
                . " Mb" : round($stat["size"] / 1000, 1) . " kb";;
            ?>
            <div>
                <?php if (getimagesize("$dir/$files[$i]")) { ?>
                    <img src="<?php echo $src_name; ?>" alt="<?php echo $files[$i]; ?>">
                <?php } else { ?>
                    <div class="placeholder">&#9778;</div>
                <?php } ?>
                <div><?php echo $files[$i]; ?></div>
                <div><?php echo $type; ?></div>
                <div><?php echo $size; ?></div>
                <div><?php echo date("Y-m-d H:i:s", $stat["mtime"]); ?></div>
            </div>
        <?php } } ?>
</div>
