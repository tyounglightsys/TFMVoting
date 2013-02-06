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
$CRITERIA_DEFAULT = array(
    array('Impact', "What is the actual/potential Kingdom impact?"),
    array('Quality', "Technical quality, usability, etc."),
    array('Cooperation', "How well does it utilize and/or encourage cooperation in the Body?"),
    array('Re-usability', "To what extent can other ministries replicate/make use of this idea?")
);

define('CRITERIA_NAME', 0);
define('CRITERIA_DESCRIPTION', 1);

/// \brief A user-configured value that tells the username to access the MySQL database.
define('DB_USERNAME', "tfm");
/// \brief A user-configured value that tells the password for DB_USERNAME for MySQL.
define('DB_PASSWORD', "tfm");
/// \brief A user-configured value that tells the address of the MySQL server.
define('DB_HOST', "127.0.0.1");
/// \brief A user-configured value stating the MySQL schema used for this web application.
define('DB_DATABASE', "tfm");

/** \brief A user-configured value that tells the web address of the folder containing
 * the voting system including the trailing slash. 
 */
define('WWW', 'http://localhost/web/');
/** \brief A user-configured value that tells the path to the folder containing the system
 * on the local machine including the trailing slash. 
 */
define('ROOT', '/Library/WebServer/Documents/web/');

define('LAYOUT_PATH_ROOT', ROOT . 'layout/');
define('LAYOUT_PATH_WWW', WWW . 'layout/');
define('INCLUDE_PATH_ROOT', ROOT . 'includes/');
define('INCLUDE_PATH_WWW', WWW . 'includes/');
define('BADGES_PATH_WWW', WWW . 'badges/');
define('COOKIE_PATH', WWW);

/// \}

?>
