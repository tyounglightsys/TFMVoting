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
        <form action="index.php">
            <p>
                Name:
                <input id="nameField" type="text" name="name" />
            </p>
            <input type="submit" value="Done" />
        </form>
        
        <!-- Cancel form -->
        <form action="index.php" method="get">
            <?php
                // Make sure we go back to the previous page if necessary
                if(isset($_REQUEST[P_NEWSET_PREV_PROJ_SET])){
                    print('<input type="hidden" value="' . htmlspecialchars($_REQUEST[P_NEWSET_PREV_PROJ_SET], ENT_QUOTES) . '" name="projectSet" />');
                }
            ?>
            <input type="submit" value="Cancel" />
        </form>
        
    </body>
</html>