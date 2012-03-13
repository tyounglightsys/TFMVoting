<?php

/** \file config.php
 * \brief This file defines different configuration variables that affect the
 * behavior of the system.
 * \defgroup config Configuration
 * \{
 */

/** \brief This variable defines the criteria for a new projects.
 *
 * Note that there is no way of editing the criteria visually at this point, the
 * only way to edit them is to set this variable before creating the project.
 * The format of this is an array of arrays, where the subarrays are a name and
 * a description.
 */
$CRITERIA_DEFAUT = array(
    array('Impact', "What is the actual/potential Kingdom impact?"),
    array('Quality', "Technical quality, usability, etc."),
    array('Cooperation', "How well does it utilize and/or encourage cooperation in the Body?"),
    array('Re-usability', "To what extent can other ministries replicate/make use of this idea?")
);
/// \}

$CRITERIA_NAME        = 0;
$CRITERIA_DESCRIPTION = 1;

define(DB_USERNAME, "tfm");
define(DB_PASSWORD, "tfm");
define(DB_HOST, "127.0.0.1");
define(DB_DATABASE, "tfm");

?>
