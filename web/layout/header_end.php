<html>
    <head>
        <title><?php ECHO htmlentities($title, ENT_QUOTES | ENT_HTML401 | ENT_HTML5) ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $layout_path_www ?>style.css">
        <?php echo $head_extra ?>

    </head>
    <body>
        <div id="header">
            <h1><?php ECHO htmlentities($title, ENT_QUOTES | ENT_HTML401 | ENT_HTML5) ?></h1>
            <?php echo $div_header_extra ?>

        </div>