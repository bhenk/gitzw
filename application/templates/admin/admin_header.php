<?php
$user = $this->getRequest()->getSessionUser()->getName();
$last_login = $this->getRequest()->getSessionUser()->getLastLogin();
?>

<div id="admin_header">
    <div class="dd_menu">
        <button class="dd_button">File</button>
        <div class="dd_content">
            <a href="/admin/upload">Upload</a>
            <a href="/admin/explore">Explore</a>
        </div>
    </div>
    <div class="dd_menu">
        <button class="dd_button">Image</button>
        <div class="dd_content">
            <a href="#">Bla bla</a>
            <a href="#">menu B2 and a bit</a>
            <a href="#">menu B3</a>
        </div>
    </div>
    <div class="dd_menu">
        <button class="dd_button">Work</button>
        <div class="dd_content">
            <a href="/admin/work/new">New work</a>
            <a href="/admin/works/order">Update order</a>
            <a href="#">menu B2 and a bit</a>
            <a href="#">menu B3</a>
        </div>
    </div>
    <div class="dd_menu">
        <button class="dd_button">System</button>
        <div class="dd_content">
            <a href="/admin/system/phpinfo">PHPInfo</a>
            <a href="#">menu B2 and a bit</a>
            <a href="#">menu B3</a>
        </div>
    </div>
    <div class="dd_menu">
        <button class="dd_button">User</button>
        <div class="dd_content">
            <a href="/logout">logout</a>
        </div>
    </div>
    <span class="username"><?php echo $user . " " . $last_login; ?></span>
</div>


