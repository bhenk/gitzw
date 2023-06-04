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
            echo $work->getRESID(); ?>" method="post">
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
                               value="<?php echo $work->getTitleNl(); ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="title_en">Title en: </label>
                        <input class="larger" type="text" id="title_en" name="title_en"
                               value="<?php echo $work->getTitleEn(); ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="pref_lang">Preferred:</label>
                        <select id="pref_lang" name="pref_lang">
                            <option value="nl"<?php
                            echo ("nl" == $work->getPreferredLanguage() ?? "") ? " selected" : "";
                                ?>>nederlands</option>
                            <option value="en"<?php
                            echo ("en" == $work->getPreferredLanguage() ?? "") ? " selected" : "";
                                ?>>english</option>
                        </select>
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="type">Type: </label>
                        <div id="type" class="cb_field"><?php
                            $type_string = strtolower(implode(";", $work->getTypes()));
                            $types = array_keys(AAT::ART_TYPES);
                            for ($i=0; $i < count($types); $i++) {
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
                               value="<?php echo $work->getMedia(); ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="dim_extra">Dim. extra: </label>
                        <input class="larger" type="text" id="dim_extra" name="dim_extra"
                               value="<?php echo $work->getDimExtra(); ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="width">Width: </label>
                        <input class="smaller" type="text" id="width" name="width" value="<?php echo $work->getWidth(); ?>"> &nbsp; cm.
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="height">Height: </label>
                        <input class="smaller" type="text" id="height" name="height" value="<?php echo $work->getHeight(); ?>"> &nbsp; cm.
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="depth">Depth: </label>
                        <input class="smaller" type="text" id="depth" name="depth" value="<?php echo $work->getDepth(); ?>"> &nbsp; cm.
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="ordinal">Ordinal: </label>
                        <input class="smaller" type="text" id="ordinal" name="ordinal" value="<?php echo $work->getOrdinal(); ?>">
                    </div>
                    <div class="form_row">
                        <label class="fm_label" for="hidden">Hide: </label>
                        <input type="checkbox" id="hidden" name="hidden"
                               value="<?php echo $work->isHidden(); ?>"<?php
                        echo ($work->isHidden()) ? " checked" : ""
                        ?>></div>
                    <div class="form_row">
                        <label class="fm_label" for="location">Location: </label>
                        <input type="text" id="location" name="location" value="<?php echo $work->getLocation(); ?>">
                    </div>
                    <div class="button_row">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="resid" value="<?php echo $work->getRESID(); ?>">
                        <input type="submit" id="submit" value="Save" name="submit">
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
