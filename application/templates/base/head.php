<?php
?>
<head>
    <title><?php echo $this->getPageTitle(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
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
