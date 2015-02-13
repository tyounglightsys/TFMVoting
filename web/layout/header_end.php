<?php
if (!isset($head_extra) || !$head_extra)
    $head_extra = '';
if (!isset($div_header_extra) || !$div_header_extra)
    $div_header_extra = '';
?><html>
    <head>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <title><?php ECHO htmlentities($title, ENT_QUOTES) ?></title>
        <link rel="stylesheet" type="text/css" href="/TFM/layout/style.css">
        <link rel="stylesheet" type="text/css" href="/TFM/layout/jquery-ui.css">
        <script src="/TFM/layout/jquery.js"></script>
        <script src="/TFM/layout/jquery-ui.js"></script>
        <?php echo $head_extra ?>

    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><?php ECHO htmlentities($title, ENT_QUOTES) ?></h1>

                <?php echo $div_header_extra ?>

            </div>