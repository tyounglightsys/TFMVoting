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
/// \}

define(CRITERIA_NAME, 0);
define(CRITERIA_DESCRIPTION, 1);

define(DB_USERNAME, "tfm");
define(DB_PASSWORD, "tfm");
define(DB_HOST, "127.0.0.1");
define(DB_DATABASE, "tfm");

define('ROOT', str_replace('\\', '/', dirname(__FILE__)) . '/', true);
function get_www_path()
{
    $http_root = $_SERVER['DOCUMENT_ROOT'];
    $script_root = ROOT;
    
    $uri = explode($http_root, $script_root);
    $http_host = $_SERVER['HTTP_HOST'];
    $www_dir = 'http://' . $http_host . $uri[1] . '/';
    return $www_dir;
}
define('WWW', get_www_path(), true);

// Set $web_dir to the location that you have the voting web project in.
$web_dir = "TFM/";

$layout_path_root = ROOT . 'layout/';
$layout_path_www = WWW . $web_dir . 'layout/';
$include_path_root = ROOT . 'includes/';
$include_path_www = WWW . $web_dir . 'includes/';
$badges_path_www = WWW . $web_dir . 'badges/';

?>
