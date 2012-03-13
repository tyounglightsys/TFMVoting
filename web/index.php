<?php

/** \file index.php
 * \brief This shows the archives of the application.
 */

require_once("config.php");
require_once("components.php");
require_once("functions.php");

?>

<html>
    <head>
        <title> TFM Results </title>
        <link href="style.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        
        <div id="header">
            <h1>Results</h1>
        </div>
        
        <?php
        if(!isset($_GET["projectSetName"])){
            ?>
            <h2>Archives</h2>
            <table>
                <tr>
                    <th> Project Name </th>
                    <th> Link </th>
                </tr>
                <tr>
                    <td> Reallynotaproject </td>
                    <td> <a href="">View</a> </td>
                </tr>
            </table>
            <?php
        }
        else{
            ?>
            <h2> Specific Project Set </h2>
            <p>
                asdfasdfg
            </p>
            <?php
        }
        ?>
        
    </body>
</html>