<?php
/** @var RepExplorerControl $ctrl */

use bhenk\gitzw\ctrla\RepExplorerControl;

$ctrl = $this;
$countByYear = $ctrl->getCountByYear();
$countBySource = $ctrl->getCountBySource();
$filter = $ctrl->getFilter();
echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>
<div id="overview_page">
    <h2>Representation explorer</h2>
    <div id="columns">
        <div id="repids">
            <span class="col_head">REPIDs by year</span>
            <div class="listing_block">
                <div>
                    <span class="span1">count</span>
                    <span>crid year</span>
                </div>
                <?php foreach ($countByYear as $cr_year => $count) { ?>
                    <div>
                        <span class="span1"><?php echo $count; ?></span>
                        <a href="/admin/representation/explore/<?php echo $cr_year; ?>"><?php echo $cr_year ?></a>
                    </div>
                <?php } ?>
                <div>
                    <span class="span1"><?php echo array_sum($countByYear) ?></span>
                    <span>representations</span>
                </div>
            </div>
        </div>
        <div id="filter_block">
            <span class="col_head">Filter</span>
            <div class="form_block">
                <form id="filter_form" action="/admin/representation/explore" method="post"
                      onchange="formSChanged(this)" onkeyup="formSChanged(this)">

                    <div class="form_row">
                        <div class="take_part">
                            <div>
                                <input type="checkbox" id="src_on" name="src_on"<?php
                                echo $filter->isSrcOn() ? " checked" : "" ?>/>
                                <label for="src_on">Source</label>
                            </div>
                            <div>
                                <input type="checkbox" id="src_not" name="src_not"<?php
                                echo $filter->isSrcNot() ? " checked" : "" ?>/>
                                <label for="src_not">Not</label>
                            </div>
                            <div>
                                <input type="checkbox" id="src_null_safe" name="src_null_safe"<?php
                                echo $filter->isSrcNullSafe() ? " checked" : "" ?>/>
                                <label for="src_null_safe">Null safe</label>
                            </div>
                        </div>
                        <div class="sources middle">
                            <?php $c = 0;
                            foreach ($countBySource as $source => $count) { ?>
                                <div class="form_row_small">
                                    <input type="checkbox" id="src_<?php echo $c; ?>" name="src[]"
                                           value="<?php echo $source; ?>"<?php
                                    echo in_array($source, $filter->getSrc()) ? " checked" : "";
                                    ?>/>
                                    <label for="src_<?php echo $c; ?>"><?php echo $source; ?></label>
                                    <span> (<?php echo $count; ?>)</span>
                                </div>
                                <?php $c++;
                            } ?>
                            <div class="form_row_small">
                                <label></label>
                                <span>&nbsp;&nbsp; (<?php echo array_sum($countBySource); ?>)</span>
                            </div>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="take_part">
                            <input type="checkbox" id="hdn_on" name="hdn_on"<?php
                            echo $filter->isHdnOn() ? " checked" : "" ?>/>
                            <label for="hdn_on">Hidden</label>
                        </div>
                        <div class="radio_vert">
                            <div>
                                <input type="radio" id="radio_hdn_and" name="hdn_and_or" value="AND"<?php
                                echo $filter->getHdnAndOr() == "AND" ? " checked" : "";
                                ?>/>
                                <label for="radio_hdn_and">AND</label>
                            </div>
                            <div>
                                <input type="radio" id="radio_hdn_or" name="hdn_and_or" value="OR"<?php
                                echo $filter->getHdnAndOr() == "OR" ? " checked" : "";
                                ?>/>
                                <label for="radio_hdn_or">OR</label>
                            </div>
                        </div>

                        <div class="middle">
                            <input type="checkbox" id="hidden" name="hidden"<?php
                            echo $filter->getHidden() == 1 ? " checked" : "" ?>/>
                            <label for="hidden">Is hidden</label>
                        </div>
                    </div>

                    <div class="form_row">
                        <div class="take_part">
                            <input type="checkbox" id="crl_on" name="crl_on"<?php
                            echo $filter->isCrlOn() ? " checked" : "" ?>/>
                            <label for="crl_on">Carousel</label>
                        </div>
                        <div class="radio_vert">
                            <div>
                                <input type="radio" id="radio_crl_and" name="crl_and_or" value="AND"<?php
                                echo $filter->getCrlAndOr() == "AND" ? " checked" : "";
                                ?>/>
                                <label for="radio_crl_and">AND</label>
                            </div>
                            <div>
                                <input type="radio" id="radio_crl_or" name="crl_and_or" value="OR"<?php
                                echo $filter->getCrlAndOr() == "OR" ? " checked" : "";
                                ?>/>
                                <label for="radio_crl_or">OR</label>
                            </div>
                        </div>
                        <div class="middle">
                            <input type="checkbox" id="carousel" name="carousel"<?php
                            echo $filter->getCarousel() == 1 ? " checked" : "" ?>/>
                            <label for="carousel">In carousel</label>
                        </div>

                    </div>

                    <div class="sql">
                        <span id="source_text"><?php
                            echo str_replace("\t", "&nbsp;&nbsp;",
                                str_replace("\n", "<br/>", $filter->getSSourceCountSql()));
                            ?></span>
                        <span title="copy sql" class="copyprevious"
                              onclick="copyPrevious2(this)" style="color: inherit;"> &#9776; </span>
                    </div>
                    <div class="button_row">
                        <input type="hidden" name="action" value="source">
                        <input type="submit" name="submit" value="Execute"/>
                    </div>
                </form>
                <form id="orphan_form" action="/admin/representation/explore" method="post"
                      onchange="formOChanged(this)" onkeyup="formOChanged(this)">
                    <div class="form_row">
                        <div>
                            <input type="checkbox" id="work_orphan" name="work_orphans"<?php
                            echo $filter->isWorkOrphans() ? " checked" : "";
                            ?>/>
                            <label for="work_orphan">Work orphans</label>
                            <input type="checkbox" id="exh_orphan" name="exh_orphans"<?php
                            echo $filter->isExhOrphans() ? " checked" : "";
                            ?>/>
                            <label for="exh_orphan">Exhibition orphans</label>
                        </div>
                    </div>
                    <div class="sql">
                        <span id="orphan_text"><?php
                            echo str_replace("\t", "&nbsp;&nbsp;",
                                str_replace("\n", "<br/>", $filter->getOSourceCountSql()));
                            ?></span>
                        <span title="copy sql" class="copyprevious"
                              onclick="copyPrevious2(this)" style="color: inherit;"> &#9776; </span>
                    </div>
                    <div class="button_row">
                        <input type="hidden" name="action" value="orphan">
                        <input type="submit" name="submit" value="Execute"/>
                        <input type="submit" name="submit" value="Clear"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function formSChanged(form) {
        let xhr = new XMLHttpRequest();
        let data = new FormData(form);
        data.append("mode", "source");
        xhr.open("POST", "/ajax/rep_explorer_sql")
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let source_text = document.getElementById("source_text");
                let json = JSON.parse(this.responseText);
                source_text.innerHTML = json.source.replace(/\n/g, "<br/>").replace(/\t/g, "&nbsp;&nbsp;");
            }
        }
    }

    function formOChanged(form) {
        let xhr = new XMLHttpRequest();
        let data = new FormData(form);
        data.append("mode", "orphan");
        xhr.open("POST", "/ajax/rep_explorer_sql")
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let orphan_text = document.getElementById("orphan_text");
                let json = JSON.parse(this.responseText);
                orphan_text.innerHTML = json.orphan.replace(/\n/g, "<br/>").replace(/\t/g, "&nbsp;&nbsp;");
            }
        }
    }
</script>

