<?php

/** \file newset.php
 * \brief A file to allow you to create a new project set.
 */

require_once("../config.php");
require_once("../components.php");
require_once("../functions.php");
require_once("../params.php");

?>

<html>
    <head>
        <title> New Project Set </title>
        <link href="../style.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div id="header">
            <h1> New Project Set </h1>
        </div>
        
        <!-- OK form --> 
        <form action="index.php" method="post">
            <p>
                Name:
                <input id="nameField" type="text" name="<?php print(htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES)) ?>" />
            </p>
            <input type="hidden" name="<?php print(htmlspecialchars(P_ADMIN_ACTION, ENT_QUOTES)) ?>" value="<?php print(htmlspecialchars(PV_ADMIN_ACTION_NEW_PROJECT_SET, ENT_QUOTES)) ?>" />
            <input type="submit" value="Done" />
        </form>
        
        <!-- Cancel form -->
        <form action="index.php" method="get">
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)) ?>" name="<?php print(htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES)) ?>" />
            <input type="submit" value="Cancel" />
        </form>
        
    </body>
</html>