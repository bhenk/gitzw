<?php
/** @var WorkControl $ctrl */

use bhenk\gitzw\base\Images;
use bhenk\gitzw\ctrla\WorkControl;
use bhenk\gitzw\model\WorkCategories;

$ctrl = $this;
$date = $ctrl->getDate();
$repr = $ctrl->getRepresentation();
$has_repr = !is_null($repr);
$repid = $ctrl->getRepid();
if ($has_repr) {
    $file_loc = $repr->getFileLocation(Images::IMG_15);
    $repid = $repr->getREPID();
}
?>

<div id="edit_work">
    <div class="work_panel">
        <div class="work_view">
            <?php if ($has_repr) { ?>
                <img src="<?php echo $file_loc; ?>" alt="representation">
            <?php } else { ?>
                <a href="/admin/representation/explore" target="_blank">
                    <div class="no_image">
                        <picture class="glower">
                            <source srcset="/img/ico/image-file-add-100-w.png" media="(prefers-color-scheme: dark)">
                            <img src="/img/ico/image-file-add-100.png" alt="search image" title="search image">
                        </picture>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="work_form">
            <form id="edit_work" name="edit_work" action="/admin/work/new" method="post">
                <h2><?php $ref_url = $ctrl->getLocalReferrerUrl();
                    if ($ref_url && !str_contains($ref_url,"/admin/work/new")) { ?>
                        <a href="<?php echo $ref_url; ?>"> &#8678;&nbsp;&nbsp; </a>
                    <?php } ?>
                    New Work</h2>
                <hr/>
                <div class="form_rows">
                    <div class="form_row">
                        <label class="fm_label" for="crid">Creator: </label>
                        <select id="crid" name="crid">
                            <?php foreach ($ctrl->getCreators() as $creator) { ?>
                                <option value="<?php echo $creator->getCRID(); ?>"
                                    <?php echo $creator->getCRID() == $ctrl->getCrid() ? "selected" : ""; ?>>
                                    <?php echo $creator->getFullName(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="category">Category: </label>
                        <select id="category" name="category">
                            <?php foreach (WorkCategories::cases() as $case) { ?>
                                <option value="<?php echo $case->name; ?>"
                                    <?php echo $case->name == $ctrl->getCategory() ? "selected" : ""; ?>>
                                    <?php echo $case->value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="date">Date: </label>
                        <input type="text" id="date" name="date" value="<?php echo $date; ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="repid">REPID:</label>
                        <input type="text" id="repid" name="repid" value="<?php echo $repid; ?>"
                               onchange="valueChanged(this)" onkeyup="valueChanged(this)">
                        <a href="/admin/representation/explore" target="_blank">&nbsp;
                            <picture class="glower">
                                <source srcset="/img/ico/image-file-add-25-w.png" media="(prefers-color-scheme: dark)">
                                <img style="height: 1em" src="/img/ico/image-file-add-25.png" alt="search"
                                     title="search image">
                            </picture>
                        </a> &nbsp;
                        <picture class="glower" onclick="pasteRepid()">
                            <source srcset="/img/ico/paste-25-w.png" media="(prefers-color-scheme: dark)">
                            <img style="height: 1em" src="/img/ico/paste-25.png" alt="paste" title="paste">
                        </picture>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="count_repid"></label>
                        <span id="count_repid"></span>
                    </div>
                    <div class="button_row">
                        <input type="hidden" name="action" value="new">
                        <input type="submit" id="submit" value="Next" name="submit">
                    </div>
                </div>
                <hr/>
            </form>
            <?php if (!empty($ctrl->getErrors())) { ?>
                <div class="error">
                    <?php foreach ($ctrl->getErrors() as $error) { ?>
                        <div>- <?php echo $error; ?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    const original = <?php echo "'$repid$date'"; ?>;
    const form = document.getElementById("edit_work");
    const repid = document.getElementById("repid");
    const date = document.getElementById("date");

    form.addEventListener("input", function () {
        submit.disabled = (repid.value === "" || date.value === "");
    });

    form.addEventListener("keyup", function () {
        submit.disabled = (repid.value === "" || date.value === "");
    });

    window.addEventListener("load", () => {
        submit.disabled = (repid.value === "" || date.value === "");
        valueChanged(repid);
    });


    function valueChanged(el) {
        const max_values = {};
        max_values['repid'] = 50;
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

    const clipBoard = navigator.clipboard;

    function pasteRepid() {
        // does not work in FF
        clipBoard.readText().then((text) => {
            document.getElementById("repid").value = text;
        })
            .catch((err) => console.error(err));
    }

</script>
