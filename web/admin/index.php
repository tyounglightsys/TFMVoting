<?php

/** \file index.php
 * \brief This file is the administrative view.
 */

require_once("../config.php");
require_once("../components.php");
require_once("../functions.php");

?>

<html>
    <head>
        <title> TFM Voting Administration </title>
        <link href="../style.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <h1> Administration </h1>
        <p>
            Select the current project set: <br />
            New Project Set
        </p>
        
        <h2> Project Set Status </h2>
        <p>
            Voting Open: <br />
            Showing Results: <br />
            Archived: <br />
        </p>
        
        <h2>Entries</h2>
        <?php
            // Generate table
        ?>
        <p>
            Add New Entry <br />
        </p>
        
    </body>
</html>