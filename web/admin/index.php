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
        <div id="header">
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
            <h1>Administration</h1>
        </div>
        
        <h2> Project Set Status </h2>
        <form action="">
            <table>
                <tr>
                    <td>Voting Open:</td>
                    <td><input type="checkbox" value="votingOpen" /></td>
                </tr>
                
                <tr>
                    <td>Showing Results:</td>
                    <td><input type="checkbox" value="showingResults" /></td>
                </tr>
                
                <tr>
                    <td>Archived: </td>
                    <td><input type="checkbox" value="archived" /></td>
                </tr>
            </table>
        </form>
        
        <h2>Entries</h2>
        <?php
            // Generate table
        ?>
        <form action="">
            <input type="submit" value="Add New Entry" />
        </form>
        
    </body>
</html>