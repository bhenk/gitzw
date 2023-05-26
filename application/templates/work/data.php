<?php
/** @var WorkViewControl $page */

use bhenk\gitzw\base\AAT;
use bhenk\gitzw\ctrl\WorkViewControl;

$page = $this;
$work = $page->getWork();
$fullUrl = $work->getCanonicalUrl(null, true);
$aat = new AAT();
$types = $aat->getTypes($work->getTypes());
$media = $aat->getMedia($work->getMedia());
?>

<div id="c3_content">
    <h1>Data</h1>

    <div id="data_id">
        <span class="resourceId"><?php echo $work->getRESID(); ?></span>
        <span title="copy ID" class="copyprevious"
              onclick="copyPrevious(this)" style="color: inherit;"> &#9776; </span>
    </div>
    <div id="data_content">
        <div>
            <div class="data_term">about</div>
            <div class="data_def">
                <a href="<?php echo $work->getFullRESID(); ?>"><?php echo $work->getFullRESID(); ?></a>
            </div>
        </div>
        <div>
            <div class="data_term">url</div>
            <div class="data_def">
                <a href="<?php echo $fullUrl; ?>"><?php echo $fullUrl; ?></a>
            </div>
        </div>
        <?php if (!empty($work->getTitleNl())) { ?>
            <div>
                <div class="data_term">title (nl)</div>
                <div class="data_def">
                    <?php echo $work->getTitleNl(); ?>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($work->getTitleEn())) { ?>
            <div>
                <div class="data_term">title (en)</div>
                <div class="data_def">
                    <?php echo $work->getTitleEn(); ?>
                </div>
            </div>
        <?php } ?>
        <?php if ($work->getWidth() > 0) { ?>
            <div>
                <div class="data_term">width</div>
                <div class="data_def">
                    <?php echo $work->getWidth(); ?> cm.
                </div>
            </div>
        <?php } ?>
        <?php if ($work->getHeight() > 0) { ?>
            <div>
                <div class="data_term">height</div>
                <div class="data_def">
                    <?php echo $work->getHeight(); ?> cm.
                </div>
            </div>
        <?php } ?>
        <div>
            <div class="data_term">date</div>
            <div class="data_def">
                <?php echo $work->getDate(); ?>
            </div>
        </div>
        <div>
            <div class="data_term">type</div>
            <div class="data_def">
                <?php foreach ($types as $term => $labels) { ?>
                    <a href="<?php echo AAT::getUrl($term); ?>" target="_blank"><?php echo $term; ?></a>
                    &nbsp; &bull; &nbsp;
                    <a href="<?php echo AAT::getPageUrl($term); ?>" target="_blank">web</a>
                    <br/>
                    <?php foreach ($labels as $label) { ?>
                        <div class="lang_term">
                            <span class="term" lang="<?php echo $label->getLanguage(); ?>"><?php echo $label->getLiteral(); ?></span>
                            <!--<span class="lang">&nbsp; (<?php /*echo $label->getLanguage(); */?>)</span>-->
                        </div>
                    <?php } ?>
                    <hr/>
                <?php } ?>
            </div>
        </div>
        <div>
            <div class="data_term">media</div>
            <div class="data_def">
                <?php foreach ($media as $term => $labels) { ?>
                    <a href="<?php echo AAT::getUrl($term); ?>" target="_blank"><?php echo $term; ?></a>
                    &nbsp; &bull; &nbsp;
                    <a href="<?php echo AAT::getPageUrl($term); ?>" target="_blank">web</a>
                    <br/>
                    <?php foreach ($labels as $label) { ?>
                        <div class="lang_term">
                            <!--<span class="lang"><?php /*echo $label->getLanguage(); */?>: </span>-->
                            <span class="term" lang="<?php echo $label->getLanguage(); ?>"><?php echo $label->getLiteral(); ?></span>
                        </div>
                    <?php } ?>
                    <hr/>
                <?php } ?>
            </div>
        </div>
        <div>
            <div class="data_term">creator</div>
            <div class="data_def">
                <a href="<?php echo $work->getCreator()->getCRID(); ?>"><?php echo $work->getCreator()->getCRID(); ?></a>
            </div>
        </div>
    </div>
    <div id="data_links">
        <a href="/<?php echo $work->getCanonicalUrl() . '.json' ?>">[ json ]</a>
    </div>
</div>