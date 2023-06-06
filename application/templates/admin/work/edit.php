<?php
/** @var WorkControl $ctrl */

use bhenk\gitzw\base\AAT;
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
            <form id="edit_work" name="edit_work" action="/admin/work/edit/<?php
            echo $work->getRESID(); ?>" method="post" onchange="formChanged(this)" onkeyup="formChanged(this)">
                <h2><?php $ref_url = $ctrl->getLocalReferrerUrl();
                    if ($ref_url && !str_contains($ref_url, "/admin/work/")) { ?>
                        <a href="<?php echo $ref_url; ?>"> &#8678;&nbsp;&nbsp; </a>
                    <?php } ?>RESID: <a href="/<?php echo $work->getCanonicalUrl(); ?>" target="_blank">
                        <span><?php echo $work->getRESID(); ?></span>
                    </a>
                    <span style="display: none"><?php echo $work->getRESID(); ?></span>
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
                        <input type="text" id="date" name="date" value="<?php echo $work->getDate(); ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="title_nl">Title nl: </label>
                        <input class="larger" type="text" id="title_nl" name="title_nl"
                               value="<?php echo $work->getTitleNl(); ?>"
                               onchange="valueChanged(this, 255)" onkeyup="valueChanged(this, 255)">
                        &nbsp; &nbsp;<span id="count_title_nl"></span>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="title_en">Title en: </label>
                        <input class="larger" type="text" id="title_en" name="title_en"
                               value="<?php echo $work->getTitleEn(); ?>"
                               onchange="valueChanged(this, 255)" onkeyup="valueChanged(this, 255)">
                        &nbsp; &nbsp;<span id="count_title_en"></span>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="pref_lang">Preferred:</label>
                        <select id="pref_lang" name="pref_lang">
                            <option value="nl"<?php
                            echo ("nl" == $work->getPreferredLanguage() ?? "") ? " selected" : "";
                            ?>>nederlands
                            </option>
                            <option value="en"<?php
                            echo ("en" == $work->getPreferredLanguage() ?? "") ? " selected" : "";
                            ?>>english
                            </option>
                        </select>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="type">Type: </label>
                        <div id="type" class="cb_field"><?php
                            $type_string = strtolower(implode(";", $work->getTypes()));
                            $types = array_keys(AAT::ART_TYPES);
                            for ($i = 0; $i < count($types); $i++) {
                                $t = $types[$i];
                                ?>

                                <div>
                                    <input type="checkbox" id="type<?php echo $i; ?>" name="type<?php echo $i;
                                    ?>" value="<?php echo $t; ?>"<?php
                                    echo (str_contains($type_string, $t)) ? " checked" : ""
                                    ?>><label class="cb_label" for="type<?php echo $i; ?>"><?php echo $t; ?></label>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="media">Media: </label>
                        <input class="larger" type="text" id="media" name="media"
                               value="<?php echo $work->getMedia(); ?>"
                               onchange="valueChanged(this, 255)" onkeyup="valueChanged(this, 255)">
                        &nbsp; &nbsp;<span id="count_media"></span>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="dim_extra">Dim. extra: </label>
                        <input class="larger" type="text" id="dim_extra" name="dim_extra"
                               value="<?php echo $work->getDimExtra(); ?>"
                               onchange="valueChanged(this, 255)" onkeyup="valueChanged(this, 255)">
                        &nbsp; &nbsp;<span id="count_dim_extra"></span>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="width">Width: </label>
                        <input class="smaller" type="text" id="width" name="width"
                               value="<?php echo $work->getWidth(); ?>"> &nbsp; cm.
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="height">Height: </label>
                        <input class="smaller" type="text" id="height" name="height"
                               value="<?php echo $work->getHeight(); ?>"> &nbsp; cm.
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="depth">Depth: </label>
                        <input class="smaller" type="text" id="depth" name="depth"
                               value="<?php echo $work->getDepth(); ?>"> &nbsp; cm.
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="ordinal">Ordinal: </label>
                        <input class="smaller" type="text" id="ordinal" name="ordinal"
                               value="<?php echo $work->getOrdinal(); ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="hidden">Hide: </label>
                        <input type="checkbox" id="hidden" name="hidden"
                               value="<?php echo $work->isHidden(); ?>"<?php
                        echo ($work->isHidden()) ? " checked" : ""
                        ?>></div>
                    <div class="form_row">
                        <label class="fm_label" for="location">Location: </label>
                        <input type="text" id="location" name="location" value="<?php echo $work->getLocation(); ?>"
                               onchange="valueChanged(this, 255)" onkeyup="valueChanged(this, 255)">
                        &nbsp; &nbsp;<span id="count_location"></span>
                    </div>
                    <div class="button_row">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="resid" value="<?php echo $work->getRESID(); ?>">
                        <input type="submit" id="submit_edit_work" value="Save" name="submit" disabled>
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

            <div class="rel_form">
                <?php $workHasRepDoes = $work->getRelations()->getRepRelations();
                $representations = $work->getRelations()->getRepresentations();
                foreach ($representations as $representation) {
                    $id = $representation->getID();
                    $rep_rel = $workHasRepDoes[$id];
                    ?>
                    <div class="rel_panel">
                        <div class="rel_img">
                            <img src="<?php echo $representation->getFileLocation(Images::IMG_01);
                            ?>" alt="<?php
                            echo $representation->getREPID(); ?>">
                        </div>
                        <div class="rel_form">
                            <form id="repr_form_<?php
                            echo $id; ?>" name="repr_form_"<?php
                            echo $id; ?> action="/admin/work/edit/<?php
                            echo $work->getRESID(); ?>" method="post"
                            onchange="formChanged(this)" onkeyup="formChanged(this)">
                                <div class="form_row">
                                    <label class="fm_label" for="repid_<?php echo $id; ?>">REPID: </label>
                                    <span id="repid_<?php echo $id; ?>">
                                        <a href="/admin/image/<?php echo $representation->getREPID(); ?>">
                                            <?php echo $representation->getREPID(); ?>
                                        </a>
                                    </span>
                                    <span style="display: none"><?php echo $representation->getREPID(); ?></span>
                                    <span title="copy REPID" class="copyprevious" onclick="copyPrevious(this)">&nbsp;&#9776; </span>
                                </div>
                                <div class="form_row">
                                    <label class="fm_label" for="rel_ids_<?php echo $id; ?>">REL IDs: </label>
                                    <span id="rel_ids_<?php echo $id; ?>">
                                        <?php echo $rep_rel->getID() . " : " . $rep_rel->getFkLeft() . " : " . $rep_rel->getFkRight(); ?></span>
                                </div>
                                <div class="form_row">
                                    <label class="fm_label" for="ordinal_<?php echo $id; ?>">Ordinal: </label>
                                    <input class="smaller" type="text" id="ordinal_<?php echo $id; ?>"
                                           name="ordinal_<?php echo $id; ?>"
                                           value="<?php echo $rep_rel->getOrdinal(); ?>">
                                </div>
                                <div class="form_row">
                                    <label class="fm_label" for="preferred_<?php echo $id; ?>">Preferred: </label>
                                    <input type="checkbox" id="preferred_<?php echo $id; ?>"
                                           name="preferred_<?php echo $id; ?>"
                                           value="<?php echo $rep_rel->isPreferred(); ?>"<?php
                                    echo ($rep_rel->isPreferred()) ? " checked" : ""
                                    ?>>
                                </div>
                                <div class="form_row">
                                    <label class="fm_label" for="hidden_<?php echo $id; ?>">Hide: </label>
                                    <input type="checkbox" id="hidden_<?php echo $id; ?>"
                                           name="hidden_<?php echo $id; ?>"
                                           value="<?php echo $rep_rel->isHidden(); ?>"<?php
                                    echo ($rep_rel->isHidden()) ? " checked" : ""
                                    ?>>
                                </div>
                                <div class="form_row">
                                    <label class="fm_label" for="description_<?php echo $id; ?>">Description: </label>
                                    <textarea id="description_<?php echo $id; ?>"
                                              name="description_<?php echo $id; ?>" rows="2" cols="43"
                                              onchange="valueChanged(this, 510)" onkeyup="valueChanged(this, 510)"
                                    ><?php echo $rep_rel->getDescription() ?></textarea>
                                </div>
                                <div class="form_row">
                                    <label class="fm_label" for="count_description_<?php echo $id; ?>"></label>
                                    <span id="count_description_<?php echo $id; ?>"></span>
                                </div>
                                <div class="button_row">
                                    <input type="hidden" name="action" value="rep_rel_<?php echo $id; ?>">
                                    <input type="hidden" name="resid" value="<?php echo $work->getRESID(); ?>">
                                    <input type="submit" id="submit_repr_form_<?php echo $id; ?>"
                                           value="Save" name="submit" disabled>
                                    <input type="submit" id="delete_<?php echo $id; ?>" value="Delete" name="submit"<?php
                                    echo (count($representations) == 1) ? " disabled" : ""?>>
                                </div>
                            </form>
                            <hr/>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="add_form">
                <form id="add_rep" name="add_rep" action="/admin/work/edit/<?php
                echo $work->getRESID(); ?>" method="post" onchange="formChanged(this)" onkeyup="formChanged(this)">
                    <div class="form_row">
                        <label class="fm_label" for="add_repid">REPID: </label>
                        <input type="text" id="add_repid" name="add_repid" value="">
                        <input type="hidden" name="resid" value="<?php echo $work->getRESID(); ?>">
                        <input type="hidden" name="action" value="add_repid">
                        <input type="submit" id="submit_add_rep" class="add_repid" name="submit" value="Add" disabled>
                    </div>
                </form>
                <?php if (!empty($ctrl->getAddErrors())) { ?>
                    <div class="error">
                        <?php foreach ($ctrl->getAddErrors() as $error) { ?>
                            <div>- <?php echo $error; ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        const scrollTo = "<?php echo $ctrl->getScrollTo() ?>";
        const element = document.getElementById(scrollTo);
        if (scrollTo !== "") {
            element.scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
        }
    });

    function valueChanged(el, max) {
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

    function formChanged(form) {
        let submit = document.getElementById("submit_" + form.id);
        submit.disabled = false;
    }
</script>
