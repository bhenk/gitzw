<?php
$user = $this->getRequest()->getSessionUser()->getName();
$last_login = $this->getRequest()->getSessionUser()->getLastLogin();
?>

<div id="admin_header">
    <a href="/" title="home"><div class="home_link"></div></a>
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
        </div>
    </div>
    <div class="dd_menu">
        <button class="dd_button">System</button>
        <div class="dd_content">
            <a href="/admin">Admin</a>
            <a href="/admin/phpinfo">PHPInfo</a>
            <a href="/admin/store">Store</a>
            <a href="/admin/deploy">Deploy</a>
        </div>
    </div>
    <div class="dd_menu">
        <button class="dd_button">User</button>
        <div class="dd_content">
            <a href="/logout">Logout</a>
        </div>
    </div>
    <span class="username"><?php echo $user . " " . $last_login; ?></span>
</div>


