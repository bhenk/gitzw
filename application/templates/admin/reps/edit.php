<?php
/** @var RepEditControl $ctrl */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\RepEditControl;

$ctrl = $this;
$repr = $ctrl->getRepresentation();
$file_loc = $repr->getFileLocation(Images::IMG_15);
$unchanged = "'" . $repr->getSource() . $repr->getDate() . $repr->getDescription() . "'";

$work_rels = $repr->getRelations()->getWorkRelations();
$works = $repr->getRelations()->getWorks();
$exh_rels = $repr->getRelations()->getExhibitionRelations();
$exhibits = $repr->getRelations()->getExhibitions();
$exif_data = $repr->getSecureExifData();
$exif_err = $exif_data["error"] ?? false;
echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>

<div id="edit_image">

    <div class="img_panel">
        <div class="img_view">
            <img src="<?php echo $file_loc ?>" alt="representation">
        </div>
        <div class="img_form">
            <form id="edit_image" name="edit_image" action="/admin/image/<?php echo $repr->getREPID() ?>" method="post">
                <h2><a href="/admin/file/explore/images/<?php echo dirname($repr->getREPID()); ?>"> &#8678;&nbsp;&nbsp; </a>
                    REPID: <span><?php echo $repr->getREPID(); ?></span>
                    <span title="copy REPID" class="copyprevious" onclick="copyPrevious(this)">&nbsp;&#9776; </span></h2>
                <div>ID: <span><?php echo $repr->getID(); ?></span>
                    <span title="copy ID" class="copyprevious" onclick="copyPrevious(this)">&nbsp;&#9776; </span>
                </div>
                <hr/>
                <div class="form_rows">
                    <div class="form_row">
                        <label for="source">Source: </label>
                        <input type="text" id="source" name="source"
                               onchange="valueChanged(this)" onkeyup="valueChanged(this)"
                               value="<?php echo $repr->getSource(); ?>" disabled>
                        <span class="toggle" onclick="toggleDisabled('source')">&nbsp;&#9919;</span>&nbsp;
                        <span id="count_source"></span>
                    </div>
                    <div class="form_row">
                        <label for="date">Date: </label>
                        <input type="text" id="date" name="date" value="<?php echo $repr->getDate(); ?>" disabled>
                        <span class="toggle" onclick="toggleDisabled('date')">&nbsp;&#9919;</span>
                    </div>
                    <div class="form_row">
                        <label for="description">Description: </label>
                        <textarea id="description" name="description" rows="7" cols="70"
                                  onchange="valueChanged(this)" onkeyup="valueChanged(this)"
                        ><?php echo $repr->getDescription() ?></textarea>
                    </div>
                    <div class="form_row">
                        <label for="count_description"></label>
                        <span id="count_description"></span>
                    </div>
                    <div class="button_row">
                        <input type="hidden" name="action" value="representation">
                        <input type="submit" id="submit" value="Save" name="submit" disabled>
                    </div>
                </div>
                <hr/>
            </form>
            <div class="img_rels">
                <h2>Work relations <?php echo count($works); ?> &nbsp;
                    <a href="/admin/work/new/<?php echo $repr->getREPID(); ?>"> New </a></h2>
                <?php foreach($works as $work) {
                    $rel = $work_rels[$work->getID()];
                    ?>
                    <div class="form_row">
                        <label for="resid">RESID: </label>
                        <a href="/<?php echo $work->getCanonicalUrl(); ?>">
                        <span id="resid"><?php echo $work->getRESID(); ?></span>
                        </a>
                        <span style="display: none"><?php echo $work->getRESID(); ?></span>
                        <span title="copy RESID" class="copyprevious" onclick="copyPrevious(this)">&nbsp;&#9776; </span>
                    </div>
                    <div class="form_row">
                        <label>Title: </label>
                        <span><?php echo $work->getTitles(); ?></span>
                    </div>
                    <div class="form_row">
                        <label>Ordinal:</label>
                        <span><?php echo $rel->getOrdinal(); ?></span>
                    </div>
                    <div class="form_row">
                        <label>Preferred:</label>
                        <span><?php echo $rel->isPreferred() ? "true" : "false"; ?></span>
                    </div>
                    <div class="form_row">
                        <label>Hidden:</label>
                        <span><?php echo $rel->isHidden() ? "true" : "false"; ?></span>
                    </div>
                    <div class="form_row">
                        <label>Description: </label>
                        <span><?php echo $rel->getDescription(); ?></span>
                    </div>
                    <hr/>
                <?php } ?>
            </div>
            <div class="img_rels">
                <h2>Exhibitions <?php echo count($exhibits); ?></h2>
            </div>
        </div>
    </div>
</div>

<div id="show_exif">
    <picture onclick="showExifData()" class="glower">
        <source srcset="/img/ico/camera-35-w.png" media="(prefers-color-scheme: dark)">
        <img src="/img/ico/camera-35.png" alt="show exif data" title="show exif data">
    </picture>
</div>

<div id="exif_data">
    <div id="hide_exif">
        <picture onclick="hideExifData()" class="glower">
            <source srcset="/img/ico/x-35-w.png" media="(prefers-color-scheme: dark)">
            <img src="/img/ico/x-35.png" alt="hide exif data" title="hide exif data">
        </picture>
    </div>
    <div class="exif">
        <h2>Exif data</h2>
        <?php if ($exif_err) {
            foreach ($exif_data as $key => $value) { ?>
                <div class="exif_row exif_error">
                    <label><?php echo $key; ?>: </label>
                    <span><?php echo $value ?></span>
                </div>
            <?php } ?>
        <?php } else {
            foreach ($exif_data as $part => $contents) { ?>
                <h3><?php echo $part; ?></h3>
                <?php foreach ($contents as $key => $value) { ?>
                    <div class="exif_row">
                        <label><?php echo $key; ?>: </label>
                        <span><?php if (gettype($value) == "array") {
                                echo var_export($value, true);
                            } else {
                                echo $value;
                            }?>
                        </span>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<script>
    const original = <?php echo $unchanged; ?>;
    const form = document.getElementById("edit_image");
    const source = document.getElementById("source");
    const date = document.getElementById("date");
    const desc = document.getElementById("description");
    const submit = document.getElementById("submit");

    form.addEventListener("input", function () {
        let current = source.value + date.value + desc.value;
        submit.disabled = current === original;
    });

    window.addEventListener("DOMContentLoaded", () => {
        let elem = document.getElementById("description");
        valueChanged(elem);

        elem = document.getElementById("source");
        valueChanged(elem);
    });

    function valueChanged(el) {
        const max_values = {};
        max_values['source'] = 100;
        max_values['description'] = 510;
        let max = max_values[el.id];
        let id = "count_" + el.id;
        let counter = document.getElementById(id);
        let val = max - el.value.length;
        if (val < 0) {
            el.value = el.value.substring(0, max);
            val = 0;
            beep();
        }
        counter.innerHTML = val + " / " + max;
    }

    function beep() {
        let snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");
        snd.play();
    }

    function toggleDisabled(id) {
        let el = document.getElementById(id);
        el.disabled = !el.disabled;
    }

    function showExifData() {
        let exif = document.getElementById("exif_data");
        exif.style.right = "0";
    }

    function hideExifData() {
        let exif = document.getElementById("exif_data");
        exif.style.right = "-800px";
    }
</script>