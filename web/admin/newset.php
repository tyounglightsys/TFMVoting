<?php

/** \file newset.php
 * \brief A file to allow you to create a new project set.
 */

require_once("../config.php");
require_once("../components.php");
require_once("../functions.php");

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
        <form action="index.php">
            <p>
                Name:
                <input id="nameField" type="text" name="name" />
            </p>
            <a href="index.php">Cancel</a>
            <input type="submit" value="Done" />
        </form>
    </body>
</html>