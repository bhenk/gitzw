<?php

/** @var WorkYearViewControl $page */

use bhenk\gitzw\ctrl\WorkYearViewControl;

$page = $this;
?>
<div class="left_pager">
<div class="works_year_btn">
    <a href="<?php echo $page->getUrlPrevious(); ?>">
        <span class="page_btn<?php echo $page->isPreviousEnabled(); ?>"> &#9664; </span>
    </a>
    <span class="page_dig">
        &nbsp;  &nbsp; <?php echo $page->getPage() . " : " . $page->getTotalPages() . " / ". $page->getTotalWorks(); ?>  &nbsp;  &nbsp; </span>
    <a href="<?php echo $page->getUrlNext(); ?>">
        <span class="page_btn<?php echo $page->isNextEnabled(); ?>"> &#9654; </span>
    </a>
</div>
</div>
