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

function DB_End($connData){
    mysql_close();
}

function DB_GetProjectSetCriteria($connData, $projectSetName){
    
}

function DB_GetProjectStates($connData, $projectSetName){
    
}

function DB_GetCurrentProjectSetName($connData){
    
}

function DB_GetAllProjectStates($connData){
    
}

/** \brief This gets all the basic data associated with the entries in a project
 * \param projectSetName The name of the project set to use.
 * \return This returns a two dimensional table with a the first column being
 * the id and the second column being the name.
 */
function DB_GetProjectEntries($projectSetName){
    
}

function DB_GetProjectEntriesWithVotes($projectSetName){
    
}

function DB_GetEntryData($connData, $entryID){
    
}

/// \}

?>