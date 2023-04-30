<?php
?>

<div id="admin_header">
    <div class="head_text">
        <span class="statistics"><?php echo $this->countCategories(); ?></span>
        <a href="/logout">
            <button class="btn">Logout</button>
        </a>
        <span><?php echo $this->getSessionUserFullName(); ?></span>
        <span class="statistics"><?php echo $this->getLastLogin(); ?></span>
    </div>
</div>
