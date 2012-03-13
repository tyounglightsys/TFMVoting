<?php

/** \file components.php
 * \brief This file defines the major GUI components used in the system.
 * \defgroup comp GUI Components
 * \{
 */

require_once("functions.php");

// Classes ---------------------------------------------------------------------

/** \brief The base class for a component that shows all entries in a project
 * set.
 */
abstract class Entry_Table{
    
    /** \brief Construct a new entry table to be built for a specific project
     * set.
     * \param name The name of the project set.
     * \param needsScores If this Entry_Table needs to query for the scores as
     * well.
     * \pre name must be a valid project set name.
     */
    function __construct($name, $needsScores){
        $this->name = $name;
        $this->criteria = DB_GetProjectSetCriteria($name);
    }
    
    // Getter ------------------------------------------------------------------
    
    /** \brief Get the criteria that this Entry_Table uses.
     * \return This returns the criteria in the same way that
     * DB_GetProjectSetCriteria does.
     */
    function getCriteria(){
        return $this->criteria;
    }
    
    // Action ------------------------------------------------------------------
    
    /** \brief Call this to call the delegated subclass capabilities to generate
     * the table in the UI.
     */
    function generate(){
        $this->writeStart();
        $res = mysql_query("SELECT `id`, `name`, `url` FROM `entry` WHERE `setname` = '" .
                       mysql_real_escape_string($this->name) .
                       "' ORDER BY `order` ASC") or die(mysql_error());
        
        while($entry = mysql_fetch_array($res)){
            $this->writeEntry($entry["id"], $entry["name"], $entry["url"]);
        }
        
        $this->writeEnd();   
    }
    
    // Delegate methods --------------------------------------------------------
    
    /** \brief This is called when we are beginning to generate the entry table.
     */
    abstract function writeStart();
    
    /** \brief Called for writing an individual cell.
    */
    abstract function writeEntry($id, $name, $url);
    
    /** \brief This is called when we are done writing the entry table.
     */
    abstract function writeEnd();
    
}

/** \brief A subclass of Entry_Table that displays a table specifically meant
 * for showing an archived project set.
 */
class Archive_Entry_Table extends Entry_Table{
    
    // Implemented for Entry_Table ---------------------------------------------
    function writeStart(){
        
    }
    
    function writeEntry($id, $name, $url){
        
    }
    
    function writeEnd(){
        
    }
    
}

/** \brief This Entry_Table subclass shows all the data the admin needs to edit
 * the entries in a project set except for adding a new entry.
 */
class Admin_Entry_Table extends Entry_Table{
    
    // Constructor -------------------------------------------------------------
    
    function __construct($name){
        parent::__construct($name, true);
        
        $this->name = $name;
        $this->criteria = DB_GetProjectSetCriteria($name);
    }
    
    // Implemented for Entry_Table ---------------------------------------------
    function writeStart(){
        print("<table>
                <tr>
                    <th>Name</th>
                    <th>URL</th>
                </tr>");
    }
    
    function writeEntry($id, $name, $url){
        print("<tr>
                <td>" . $name . "</td>
                <td>" . $url . "</td>
              </tr>");
    }
    
    function writeEnd(){
        print("</table>");
    }
    
}

/** \brief A subclass of Entry_Table that shows all the entries for voting on.
 */
class Voting_Entry_Table extends Entry_Table{
    
    // Implemented for Entry_Table ---------------------------------------------
    function writeStart(){
        
    }
    
    function writeEntry($id, $name, $url){
        
    }
    
    function writeEnd(){
        
    }
    
}

/// \}

?>

