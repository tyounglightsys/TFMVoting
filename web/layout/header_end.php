<html>
    <head>
        <title><?php ECHO htmlentities($title, ENT_QUOTES) ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo LAYOUT_PATH_WWW ?>style.css">
        <?php echo $head_extra ?>

    </head>
    <body>
        <div id="header">
            <h1><?php ECHO htmlentities($title, ENT_QUOTES) ?></h1>
            <?php echo $div_header_extra ?>

        </div>