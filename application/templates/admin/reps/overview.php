<?php
/** @var RepExplorerControl $ctrl */

use bhenk\gitzw\ctrla\RepExplorerControl;

$ctrl = $this;
$countByYear = $ctrl->getCountByYear();
$countBySource = $ctrl->getCountBySource();
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
                <?php foreach ($countByYear as $rep_year => $count) { ?>
                    <div>
                        <span class="span1"><?php echo $count; ?></span>
                        <a href="/admin/file/explore/images/<?php echo $rep_year; ?>"><?php echo $rep_year ?></a>
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
                      onchange="formChanged(this)" onkeyup="formChanged(this)">
                    <hr/>
                    <div class="form_row">
                        <div class="take_part">
                            <input type="checkbox" id="src_on" name="src_on"/>
                            <label for="src_on">Source</label>
                        </div>
                        <div class="sources middle">
                            <?php $c = 0;
                            foreach ($countBySource as $source => $count) { ?>
                                <div class="form_row">
                                    <input type="checkbox" id="src_<?php echo $c; ?>" name="src[]" value="<?php echo $source; ?>"/>
                                    <label for="src_<?php echo $c; ?>"><?php echo $source; ?></label>
                                    <span> (<?php echo $count; ?>)</span>
                                </div>
                                <?php $c++;
                            } ?>
                        </div>
                        <div class="radio_vert">
                            <div>
                                <input type="radio" id="radio_src_and" name="src_and_or" value="AND" checked/>
                                <label for="radio_src_and">AND</label>
                            </div>
                            <div>
                                <input type="radio" id="radio_src_or" name="src_and_or" value="OR"/>
                                <label for="radio_src_or">OR</label>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="form_row">
                        <div class="take_part">
                            <input type="checkbox" id="hdn_on" name="hdn_on"/>
                            <label for="hdn_on">Hidden</label>
                        </div>
                        <div class="middle">
                            <input type="checkbox" id="hidden" name="hidden"/>
                            <label for="hidden">Is hidden</label>
                        </div>
                        <div class="radio_vert">
                            <div>
                                <input type="radio" id="radio_hdn_and" name="hdn_and_or" value="AND" checked/>
                                <label for="radio_hdn_and">AND</label>
                            </div>
                            <div>
                                <input type="radio" id="radio_hdn_or" name="hdn_and_or" value="OR"/>
                                <label for="radio_hdn_or">OR</label>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="form_row">
                        <div class="take_part">
                            <input type="checkbox" id="crl_on" name="crl_on"/>
                            <label for="crl_on">Carousel</label>
                        </div>
                        <div class="middle">
                            <input type="checkbox" id="carousel" name="carousel"/>
                            <label for="carousel">In carousel</label>
                        </div>

                    </div>
                    <hr/>
                </form>

            </div>
            <div id="sql">
                <span id="sql_text"><?php echo $ctrl->getSql(); ?></span>
                <span title="copy sql" class="copyprevious"
                      onclick="copyPrevious(this)" style="color: inherit;"> &#9776; </span>
            </div>
        </div>
    </div>
</div>

<script>
    function formChanged(form) {
        let xhr = new XMLHttpRequest();
        let data = new FormData(form);
        data.append("mode","intermediate");
        xhr.open("POST", "/ajax/rep_explorer_sql")
        xhr.send(data);

        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(this.responseText);
                let sql_text = document.getElementById("sql_text");
                sql_text.innerHTML = json.sql;
            }
        }
    }
</script>

