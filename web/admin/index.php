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
        <h1>
            Administration
            <div id="projectSetActions"> 
                <form action="">
                    <select name="projectSet">
                        <option value="placeholder" selected="true"> Project Set List </option>
                    </select>
                    <input type="submit" value="Change Project Set" />
                    <br />
                    <input type="submit" value="New Project Set" />
                </form>
            </div>
        </h1>
        
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