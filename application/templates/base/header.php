<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php $this->getPageTitle(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/base/normalize.css">
    <?php
    foreach (array_unique($this->getStylesheets()) as $stylesheet) {
        echo "<link rel='stylesheet' href='$stylesheet'>\n";
    }
    ?>
    <script type="text/javascript" src="/js/ani.js"></script>
    <?php
    foreach (array_unique($this->getScriptLinks()) as $link) {
        echo "<script type='text/javascript' src='$link'></script>\n";
    }
    ?>
</head>
