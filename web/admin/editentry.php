<?php

/** \file editentry.php
 * \brief A file to edit a new entry or a currently existing entry.
 */

require_once("../config.php");
require_once("../components.php");
require_once("../functions.php");

?>

<html>
    <head>
        <title> Edit Entry </title>
        <link href="../style.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div id="header">
            <h1> Edit Entry </h1>
        </div>
        <form action="index.php">
            <p>
                Name: <input id="nameField" type="text" name="name" />
            </p>
            <hr />
            <p> 
                Description:
            </p>
            <p>
                <textarea name="description" id="descriptionField"></textarea>
            </p>
            <a href="index.php">Cancel</a>
            <input type="submit" value="Done" />
        </form>
    </body>
</html>