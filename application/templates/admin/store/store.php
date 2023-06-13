<?php

use bhenk\gitzw\ctrla\StoreControl;
use bhenk\gitzw\dajson\Registry;
use bhenk\gitzw\dat\Store;

/** @var StoreControl $ctrl */
$ctrl = $this;
$registry = Registry::actionRegistry();
$serializationStats = $ctrl->getSerializationStats();
$storeStats = $ctrl->getStoreStats();
?>

<div id="store_page">
    <h1>Store</h1>

    <div class="info_block">
        <h2>Serialize</h2>
        <div class="info_row">
            <div>
                This action will serialize the store to json-files per business object.
            </div>
        </div>
        <div class="info_sub_block">
            <div class="info_head">
                Serialization stats (files in directory)
            </div>
            <?php foreach ($serializationStats as $name => $count) { ?>
                <div class="info_row">
                    <label>- <?php echo $name; ?>:</label>
                    <span><?php echo $count; ?></span>
                </div>
            <?php } ?>
            <div class="info_row">
                <label>- Total files:</label>
                <span><?php echo array_sum($serializationStats); ?></span>
            </div>
        </div>
        <div class="info_row">
            <label>Target directory:</label>
            <span><?php echo Store::getDataStore(); ?></span>
            <a href="/admin/store/store.tar.gz">download tar.gz</a>
        </div>
        <div class="info_row">
            <label>Last modified:</label>
            <span><?php echo $registry->getActionByAcid("STORE_S")->getLastModifiedToString(); ?></span>
        </div>
        <form action="/admin/store" method="post">
            <div class="button_panel">
                <input type="hidden" name="action" value="serialize">
                <input type="submit" name="submit" value="Serialize" onclick="startProgressBar('progress_store_s')">
            </div>
        </form>
        <div id="progress_store_s" class="progress">
            <div>&nbsp;</div>
            <div><?php $c = $ctrl->getSerializedRecordCount();
                echo $c == -1 ? "&nbsp;" : "100%"; ?></div>
            <div>&nbsp;</div>
        </div>
        <?php foreach ($ctrl->getSerializationResult() as $name => $count) { ?>
            <div class="info_row">
                <label>- <?php echo $name; ?>:</label>
                <span><?php echo $count; ?></span>
            </div>
        <?php } ?>
    </div>

    <div class="info_block">
        <h2>Deserialize</h2>
        <div class="info_row">
            <div>
                This action will recreate business objects from json files and store them.
            </div>
        </div>
        <div class="info_sub_block">
            <div class="info_head">
                Store stats (objects in database)
            </div>
            <?php foreach ($storeStats as $name => $count) { ?>
                <div class="info_row">
                    <label>- <?php echo $name; ?>:</label>
                    <span><?php echo $count; ?></span>
                </div>
            <?php } ?>
            <div class="info_row">
                <label>- Total objects:</label>
                <span><?php echo array_sum($storeStats); ?></span>
            </div>
        </div>
        <div class="info_row">
            <label>Source directory:</label>
            <span><?php echo Store::getDataStore(); ?></span>
        </div>
        <div class="info_row">
            <label>Last modified:</label>
            <span><?php echo $registry->getActionByAcid("STORE_D")->getLastModifiedToString(); ?></span>
        </div>
        <form action="/admin/store" method="post">
            <div class="button_panel">
                <?php if ($ctrl->showDeserialize()) { ?>
                    <input type="hidden" name="action" value="do_deserialize">
                    <input class="serious" type="submit" name="submit" value="Deserialize" onclick="startProgressBar('progress_store_d')">
                    <input type="submit" name="submit" value="Cancel">
                    <span class="serious">Are you sure? Database tables will be dropped!</span>
                <?php } else { ?>
                    <input type="hidden" name="action" value="try_deserialize">
                    <input type="submit" name="submit" value="Deserialize">
                <?php } ?>
            </div>
        </form>

        <div id="progress_store_d" class="progress">
            <div>&nbsp;</div>
            <div><?php $c = $ctrl->getStoredObjectCount();
                echo $c == -1 ? "&nbsp;" : "100%"; ?></div>
            <div>&nbsp;</div>
        </div>
        <?php foreach ($ctrl->getStoreResult() as $name => $count) { ?>
            <div class="info_row">
                <label>- <?php echo $name; ?>:</label>
                <span><?php echo $count; ?></span>
            </div>
        <?php } ?>
    </div>
</div>

<script>

    window.addEventListener("DOMContentLoaded", function () {
        progressBar("progress_store_s");
        progressBar("progress_store_d");
    });


    function progressBar(id) {
        const char = "&#9600;"
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            let div = document.getElementById(id);
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(this.responseText);
                div.children[0].innerHTML = char.repeat((json.progress / 1.75) + 1);
                div.children[1].innerHTML = json.progress + "%";
                div.children[2].innerHTML = json.message;
            } else {
                console.log(this.status + " " + this.statusText + " " + this.responseText);
            }
        };
        xmlhttp.open("GET", "/ajax/progress?id=" + id, true);
        xmlhttp.send();
    }

    function startProgressBar(id) {
        progressBar(id);
        setInterval(progressBar, 200, id);
    }

</script>
