<?php

use bhenk\gitzw\dat\Store;

?>
<div id="home_div1">
    <div id="home_div2">
        <div id="home_page">
            <div id="home_logo">
                GITZW.ART
            </div>

            <div id="home_band">
                <div class="band_part">
                    <a href="/<?php echo Store::workStore()->selectNearestUpByOrder(9999)->getCanonicalUrl(); ?>">archive</a>
                </div>
                <div class="band_part">
                    <a href="/henk-van-den-berg">hnq</a>
                </div>
                <div class="band_part">
                    <a href="/henk-van-den-berg/work/drawing">draw</a>
                </div>
                <div class="band_part">
                    <a href="/henk-van-den-berg/work/drypoint">dry</a>
                </div>
                <div class="band_part">
                    <a href="/henk-van-den-berg/work/painting">paint</a>
                </div>
                <div class="band_end">
                    <a href="/login">login</a>
                </div>
            </div>
        </div>
    </div>
</div>