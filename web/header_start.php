<?php

/** \file header.php
 * \brief This file contains something that just about every other page contains. It's also very neat.
 *
 * Note: If you want the information to display, you must set
 *     $title, $head_extra, and/or $div_header_extra BEFORE
 *     including this file.
 *
 *  - $title defines the title of the page and the text at the
 *        top of the page.
 *  - $head_extra may define extra stylesheets, scripts, etc.
 *  - $div_header_extra may define any extra header div information,
 *        shown at the top of the page.
 */

// Requires --------------------------------------------------------------------
require_once("../config.php");
require_once("../components.php");
require_once("../functions.php");

// Variables -------------------------------------------------------------------
$projectSet = null;

// Generation ------------------------------------------------------------------
DB_Start();

// Get current project set
if(isset($_GET["projectSet"]) && DB_GetProjectSetExists($_GET["projectSet"])){
    $projectSet = $_GET["projectSet"];
}

?>