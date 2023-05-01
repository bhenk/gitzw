<?php
?>

<div id="admin_rep_list_2">
    <div><?php echo $this->getOffset(); ?></div>
    <a href="/admin/representations/previous/<?php echo $this->getOffset(); ?>">
        <button class="btn"<?php echo $this->previousDisabled(); ?>>&#8678;</button>
    </a>
    <a href="/admin/representations/next/<?php echo $this->getOffset(); ?>">
        <button class="btn"<?php echo $this->nextDisabled(); ?>>&#8680;</button>
    </a>
</div>
