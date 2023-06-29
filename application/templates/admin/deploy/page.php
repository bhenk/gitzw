<?php
/** @var DeployControl $ctrl */

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrla\DeployControl;
use bhenk\gitzw\dajson\Registry;

$ctrl = $this;
$registry = Registry::actionRegistry();
echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>

<div id="deploy_page">
    <h1>Deploy</h1>

    <div class="info_block">
        <h2>Update order of works</h2>
        <div class="info_row">
            <div>
                This action will update column <code>order</code> in <code>tbl_works</code>.
            Column <code>order</code> is used to order
            works along <code>category, YEAR(date), ordinal</code>.
            </div>
        </div>
        <div class="info_row">
            <label>Total records:</label>
            <span><?php echo $ctrl->getTotalWorks(); ?></span>
        </div>
        <div class="info_row">
            <label>Last modified:</label>
            <span><?php echo $registry->getActionByAcid("UOOW")->getLastModifiedToString(); ?></span>
        </div>
        <form action="/admin/system/deploy" method="post">
            <div class="button_panel">
                <input type="hidden" name="action" value="update_order">
                <input type="submit" name="submit" value="Update" onclick="startProgressBar('progress_order')">
            </div>
        </form>
        <div id="progress_order" class="progress">
            <div>&nbsp;</div>
            <div><?php $c = $ctrl->getUpdateOrderCount(); echo $c == -1 ? "&nbsp;" : "100%"; ?></div>
            <div>&nbsp;</div>
        </div>
    </div>

    <div class="info_block">
        <h2>Create cache</h2>
        <div class="info_row">
            <label>Cache configuration:</label>
            <span><?php echo Env::configurationDir() . "/web_config.php"; ?></span>
        </div>
        <div class="info_row">
            <label>Use cache:</label>
            <span><?php echo Env::useCache() ? "on" : "off"; ?></span>
        </div>
        <div class="info_row">
            <label>Cache directory:</label>
            <span><?php echo Env::cacheDir(); ?></span>
        </div>
        <div class="info_row">
            <label>Current html files:</label>
            <span><?php echo count(glob(Env::cacheDir() . "/*.html")); ?></span>
        </div>
        <div class="info_row">
            <label>Last modified:</label>
            <span><?php echo $registry->getActionByAcid("CACHE")->getLastModifiedToString(); ?></span>
        </div>
        <form action="/admin/system/deploy" method="post">
            <div class="button_panel">
                <input type="hidden" name="action" value="create_cache">
                <input type="submit" name="submit" value="Create" onclick="startProgressBar('progress_cache')">
            </div>
        </form>
        <div id="progress_cache" class="progress">
            <div>&nbsp;</div>
            <div><?php $c = $ctrl->getCreateCacheCount(); echo $c == -1 ? "&nbsp;" : "100%"; ?></div>
            <div>&nbsp;</div>
        </div>
    </div>
    <div class="info_block">
        <h2>Create sitemap</h2>
        <div class="info_row">
            <label>Location SM:</label>
            <span><?php echo $ctrl->getSitemapFilename(); ?></span>
            <a href="/sitemap.xml" target="_blank">open &#10697;</a>
        </div>
        <div class="info_row">
            <label>Current entries:</label>
            <span><?php echo $ctrl->getCountSitemapEntries(); ?></span>
        </div>
        <div class="info_row">
            <label>Location LM:</label>
            <span><?php echo $ctrl->getSMLastModifiedFilename(); ?></span>
        </div>
        <div class="info_row">
            <label>Last modified:</label>
            <span><?php echo $registry->getActionByAcid("SITEMAP")->getLastModifiedToString(); ?></span>
        </div>
        <form action="/admin/system/deploy" method="post">
            <div class="button_panel">
                <input type="hidden" name="action" value="create_sitemap">
                <input type="submit" name="submit" value="Create" onclick="startProgressBar('progress_sitemap')">
            </div>
        </form>
        <div id="progress_sitemap" class="progress">
            <div>&nbsp;</div>
            <div><?php $c = $ctrl->getCreateSitemapCount(); echo $c == -1 ? "&nbsp;" : "100%"; ?></div>
            <div>&nbsp;</div>
        </div>
    </div>
</div>

<?php if (!empty($ctrl->getErrors())) { ?>
    <div class="error">
        <?php foreach ($ctrl->getErrors() as $error) { ?>
            <div>- <?php echo $error; ?></div>
        <?php } ?>
    </div>
<?php } ?>

<script>

    window.addEventListener("DOMContentLoaded", function () {
        progressBar("progress_order");
        progressBar("progress_cache");
        progressBar("progress_sitemap");
    });



    function progressBar(id) {
        const char = "&#9600;"
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            let div = document.getElementById(id);
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(this.responseText);
                div.children[0].innerHTML = char.repeat((json.progress/1.75) + 1);
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