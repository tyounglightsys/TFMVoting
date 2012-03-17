<?php
if (!isset($head_extra) || !$head_extra)
    $head_extra = '';
if (!isset($div_header_extra) || !$div_header_extra)
    $div_header_extra = '';
?><html>
    <head>
        <title><?php ECHO htmlentities($title, ENT_QUOTES) ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo LAYOUT_PATH_WWW ?>style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo LAYOUT_PATH_WWW ?>jquery-ui.css">
        <script src="<?php echo LAYOUT_PATH_WWW ?>jquery.js"></script>
        <script src="<?php echo LAYOUT_PATH_WWW ?>jquery-ui.js"></script>
        <?php echo $head_extra ?>

    </head>
    <body>
        <div id="header">
            <h1><?php ECHO htmlentities($title, ENT_QUOTES) ?></h1>
            <?php echo $div_header_extra ?>

        </div>