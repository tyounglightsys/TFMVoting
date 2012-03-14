<?php

/** \file functions.php
 * \brief This file implements the interfacing with the MySQL database.
 * \defgroup database Database Connection
 * \{
 */

// Functions -------------------------------------------------------------------

/** \brief Connect to the database for the data.
 *
 * This never returns a failure, as it dies on failure.
 * \param host The host to connect to.
 * \param user The username to log in with.
 * \param password The password to log in to the database with.
 * \param database The database in which all of the table data resides.
 */
function DB_Start($host = DB_HOST, $user = DB_USERNAME, $password = DB_PASSWORD, $database = DB_DATABASE){
    mysql_connect($host, $user, $password) or die(mysql_error());
    mysql_selectdb($database) or die(mysql_error());
}

/** \brief End the connection to the database.
 */
function DB_End(){
    mysql_close();
}

/** \brief Get the criteria associated with a specific project set.
 * \param projectSetName The name of the project set to get the critera from.
 * \return This returns an array of associative arrays which will have the keys
 * "name", "description", and "id".  This will return an empty array on an
 * invalid projectSetName.  It is ordered by id in ascending order. 
 */
function DB_GetProjectSetCriteria($projectSetName){
    $res = mysql_query("SELECT `id`, `name`, `description`  FROM `criteria` WHERE `setname` = '" .
                       mysql_real_escape_string($projectSetName) .
                       "' ORDER BY `id`") or die(mysql_error());
    $toRet = array();
    
    while($row = mysql_fetch_array($res)){
        array_push($toRet, $row);
    }
    
    return $toRet;
}

/** \brief This returns an associative array of the different states of the
 * project set that is requested.
 *
 * The returned associative array will have the keys "resultsVisible",
 * "votingOpen", and "archived".
 * \param projectSetName The name of the project set to query the states of.
 * \return This returns an associative array of the states that are associated
 * with the project set.  This returns false on error, such as not finding the
 * specified project set.
 */
function DB_GetProjectSetStates($projectSetName){
    $res = mysql_query("SELECT `resultsVisible`, `votingOpen`, `archived`  FROM `set` WHERE `name` = '" .
                       mysql_real_escape_string($projectSetName) .
                       "'") or die(mysql_error());
    $row = mysql_fetch_array($res);
    return $row;
}

/** \brief Get the most recently made project set name from the database.
 * \return This returns the name of the current project or false if there is no
 * current project.
 */
function DB_GetCurrentProjectSetName(){
    $res = mysql_query("SELECT `name`  FROM `set` ORDER BY `date` DESC LIMIT 1") or die(mysql_error());
    $row = mysql_fetch_row($res);
    if($row){
        return $row[0];
    }
    else{
        return false;
    }
}

/** \brief Get all the project set names from the database.
 * \return This returns an array of names of the projects.
 */
function DB_GetAllProjectSetNames(){
    $res = mysql_query("SELECT `name` FROM `set` ORDER BY `date` DESC") or die(mysql_error());
    $names = array();
    
    while($row = mysql_fetch_row($res)){
        array_push($names, $row[0]);
    }
    
    return $names;
}

/** \brief See if a given project set even exists.
 * \param projectSetName The name of the project set to test for.
 * \return This returns a boolean stating if the project exists.
 */
function DB_GetProjectSetExists($projectSetName){
    $res = mysql_query("SELECT `name` FROM `set` WHERE `name` = '" .
                       mysql_real_escape_string($projectSetName) .
                       "' LIMIT 1") or die(mysql_error());
    $row = mysql_fetch_row($res);
    return (boolean)$row;
}

/** \brief Get all the project states of all projects.
 * \return This returns an array of associative arrays with the keys "name",
 * "resultsVisible", "votingOpen", and "archived" or an empty array if there
 * are no project sets.
 */
function DB_GetAllProjectSetStates(){
    $res = mysql_query("SELECT `name`, `resultsVisible`, `votingOpen`, `archived`
                            FROM `set`
                            ORDER BY `date` DESC") or die(mysql_error());
    $toRet = array();
    while($row = mysql_fetch_array($res)){
        array_push($toRet, $row);
    }
    return $toRet;
}

/** \brief Set the states associated with a project set.
 * \param projectSetName The name of the project set.
 * \param votingOpen If the project set is supposed to be open.
 * \param resultsVisible If the results should be visible.
 * \param archived If the project set is supposed to be archived.
 */
function DB_SetProjectSetStates($projectSetName, $votingOpen, $resultsVisible, $archived){
    mysql_query("UPDATE `set` SET `resultsVisible` = " . (int)$resultsVisible . ",
                            `votingOpen` = " . (int)$votingOpen . ",
                            `archived` = " . (int)$archived . "
                    WHERE `name` = '" . mysql_escape_string($projectSetName) . "'")or die(mysql_error());
}

/** \brief Create a project set with a given name.
 * \param setName The name of the set to create.
 * \param criterias An array of arrays that contain two elements, the first one
 * being a string for the criteria name and the second being a string for the
 * criteria description.
 */
function DB_CreateProjectSet($setName, $criterias){
    if(!DB_GetProjectSetExists($setName)){
        
        // Insert the project set
        mysql_query("INSERT INTO `set` (`name`, `resultsVisible`, `votingOpen`, `archived`)
                    VALUES ('" . mysql_escape_string($setName) . "', 0, 0, 0)") or die(mysql_error());
        
        // Add all the criteria
        foreach($criterias as $criteria){
            mysql_query("INSERT INTO `criteria` (`setname`, `name`, `description`)
                            VALUES ('" . mysql_escape_string($setName) . "', '" .
                                        mysql_escape_string($criteria[0]) . "', '" .
                                        mysql_escape_string($criteria[1]) . "')") or die(mysql_error());
        }
    }
}

/** \brief Create an entry to a project set.
 * \param entryName The name of the entry to create.
 * \param url The URL associated with the entry.
 * \param description The description of the entry.
 * \param sensitive If the entry is to be hidden in archive views.
 */
function DB_CreateEntry($projectSet, $entryName, $url, $description, $sensitive){
    mysql_query("INSERT INTO `entry` (`setname`, `url`, `name`, `description`, `sensitive`) VALUES ('" .
                mysql_escape_string((string)$projectSet) . "', '" .
                mysql_escape_string((string)$url) . "', '" .
                mysql_escape_string((string)$entryName) . "', '" .
                mysql_escape_string((string)$description) . "', " .
                (int)$sensitive . ")") or die(mysql_error());
}

/// \}

?>