<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

require_once('../config.php');
require_once('../components.php');
require_once('../functions.php');

// Initiate connection to MySQL server
DB_Start();

$projectSet = null;

if (isset($_GET["projectSet"]) && DB_GetProjectSetExists($_GET["projectSet"])) {
    $projectSet = $_GET["projectSet"];
} else {
    $projectSet = DB_GetCurrentProjectSetName();
    if (!$projectSet) {
        $projectSet = null;
    }
}

$title = htmlentities($projectSet, ENT_QUOTES | ENT_HTML401) . ' Project Voting';
?>
<html>
    <head>
        <title><?php ECHO $title ?></title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <script src="../html5slider.js"></script>
        <script type="text/javascript">
            function displaySliderValue(elementId, value) {
                var elem = document.getElementById(elementId);
                elem.innerHTML = value;
            }
        </script>
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="header"><h1><?php ECHO $title ?></h1></div>
        <?php
            $votingTable = new Voting_Entry_Table($projectSet);
            $votingTable->generate();?>
    </body>
</html>