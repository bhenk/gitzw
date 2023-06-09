<?php
/** @var DeployControl $ctrl */

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrla\DeployControl;

$ctrl = $this;
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
        <form action="/admin/deploy" method="post">
            <div class="button_panel">
                <input type="hidden" name="action" value="update_order">
                <input type="submit" name="submit" value="Update" onclick="showProgressOrder()">
            </div>
        </form>
        <div id="progressbar_order" class="progress">
            <?php $c = $ctrl->getUpdateOrderCount(); echo $c == -1 ? "" : "updated $c records"; ?>
        </div>
        <hr/>
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
        <form action="/admin/deploy" method="post">
            <div class="button_panel">
                <input type="hidden" name="action" value="create_cache">
                <input type="submit" name="submit" value="Create" onclick="showProgressCreateCache()">
            </div>
        </form>
        <div id="progressbar_cache" class="progress">
            <?php $c = $ctrl->getCreateCacheCount(); echo $c == -1 ? "" : "created $c cache files"; ?>
        </div>
        <hr/>
    </div>

    <?php if (!empty($ctrl->getErrors())) { ?>
        <div class="error">
            <?php foreach ($ctrl->getErrors() as $error) { ?>
                <div>- <?php echo $error; ?></div>
            <?php } ?>
        </div>
    <?php } ?>

</div>

<script>

    function showProgressOrder() {
        let el = document.getElementById("progressbar_order");
        el.innerHTML = el.innerHTML + "&#9600;";
        setTimeout(showProgressOrder, 150);
    }

    function showProgressCreateCache() {
        let el = document.getElementById("progressbar_cache");
        el.innerHTML = el.innerHTML + "&#9600;";
        setTimeout(showProgressCreateCache, 4000);
    }
</script>