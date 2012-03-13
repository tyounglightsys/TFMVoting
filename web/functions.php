<?php

/** \file functions.php
 * \brief This file implements the interfacing with the MySQL database.
 * \defgroup database Database Connection
 * \{
 */

function DB_Start($host, $user, $password, $database){
    mysql_connect($host, $user, $password) or die(mysql_error());
    mysql_selectdb($database) or die(mysql_error());
}

function DB_End(){
    mysql_close();
}

function DB_GetProjectSetCriteria($projectSetName){
    
}

function DB_GetProjectStates($projectSetName){
    
}

/** \brief Get the most recently made project set name from the database.
 * \return This returns the name of the current project or false if there is no
 * current project.
 */
function DB_GetCurrentProjectSetName(){
    $res = mysql_query("SELECT `name`  FROM `set` ORDER BY `date` LIMIT 1") or die(mysql_error());
    $row = mysql_fetch_row($res);
    if($row){
        return $row[0];
    }
    else{
        return null;
    }
}

/** \brief Get all the project set names from the database.
 * \return This returns an array of names of the projects.
 */
function DB_GetAllProjectSetNames(){
    $res = mysql_query("SELECT `name` FROM `set` ORDER BY `date`") or die(mysql_error());
    $names = array();
    
    while($row = mysql_fetch_row($res)){
        array_push($names, $row[0]);
    }
    
    return $names;
}

function DB_GetAllProjectStates(){
    
}

/** \brief This gets all the basic data associated with the entries in a project
 * \param projectSetName The name of the project set to use.
 * \return This returns a two dimensional table with a the first column being
 * the id and the second column being the name. The third column is the
 * url. If the query did not work, false is returned.
 */
function DB_GetProjectEntries($projectSetName){
    if(mysql_query("SELECT `id`, `name`, `url` WHERE `setname` = `" . mysql_real_escape_string($projectSetName) . "`")){
        return mysql_fetch_array();
    }
    else{
        return false;
    }
}

function DB_GetProjectEntriesWithVotes($projectSetName){
    
}

function DB_GetEntryData($connData, $entryID){
    
}

/// \}

?>