<?php
$user = $this->getRequest()->getSessionUser()->getName();
$last_login = $this->getRequest()->getSessionUser()->getLastLogin();
echo "<!-- Control: " . $this::class . " template: " . __FILE__ . " -->";
?>

<div id="admin_header">
    <a href="/" title="home"><div class="home_link"></div></a>
    <div class="dd_menu">
        <button class="dd_button">File</button>
        <div class="dd_content">
            <a href="/admin/file/upload">Upload</a>
            <a href="/admin/file/explore">Explore</a>
        </div>
    </div>
    <div class="dd_menu">
        <button class="dd_button">Representation</button>
        <div class="dd_content">
            <a href="/admin/representation/explore">Explore</a>
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
            <a href="/admin/system/phpinfo">PHPInfo</a>
            <a href="/admin/system/store">Store</a>
            <a href="/admin/system/deploy">Deploy</a>
            <a href="/foo/bar/baz">Not found page</a>
            <a href="/admin/system/error_page">Error page</a>
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


