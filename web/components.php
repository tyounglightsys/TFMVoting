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
        $this->needsScores = $needsScores;
        
        // Run the actual query
        if($needsScores){
            $this->res = mysql_query("SELECT `id`, `name`, `url`, IFNULL((SELECT SUM(s.value) FROM `vote` as v INNER JOIN `vote_subresults` as s ON s.voteid = v.id WHERE v.entryid = e.id), 0) as totalScore FROM `entry` as e WHERE `setname` = '" .
                           mysql_real_escape_string($this->name) .
                           "' ORDER BY `order` ASC") or die(mysql_error());
        }
        else{
            $this->res = mysql_query("SELECT `id`, `name`, `url` 0 as totalScore FROM `entry` WHERE `setname` = '" .
                           mysql_real_escape_string($this->name) .
                           "' ORDER BY `order` ASC") or die(mysql_error());
        }
        
        // Get total scores
        $this->scores = array();
        if($needsScores){
            $this->scores = array();
            if(mysql_numrows($this->res) > 0){
                mysql_data_seek($this->res, 0);
                
                while($entry = mysql_fetch_array($this->res)){
                    array_push($this->scores, $entry["totalScore"]);
                }
                
                arsort($this->scores);
            }
        }
    }
    
    // Getters -----------------------------------------------------------------
    
    /** \brief Get the criteria that this Entry_Table uses.
     * \return This returns the criteria in the same way that
     * DB_GetProjectSetCriteria does.
     */
    function getCriteria(){
        return $this->criteria;
    }
    
    /** \brief Get a sorted array of all scores for all projects.
     */
    function getAllTotalScores(){
        return $this->scores;
    }
    
    // Action ------------------------------------------------------------------
    
    /** \brief Call this to call the delegated subclass capabilities to generate
     * the table in the UI.
     */
    function generate(){        
        $this->writeStart();
        
        if(mysql_numrows($this->res) > 0){
            mysql_data_seek($this->res, 0);
            
            while($entry = mysql_fetch_array($this->res)){
                $scores = array();
                if($this->needsScores){
                    foreach($this->getCriteria() as $criteria){
                        $res = mysql_query("SELECT
                                                IFNULL(
                                                    SUM(
                                                        (SELECT SUM(s.value)
                                                            FROM `vote_subresults` AS s
                                                        WHERE s.voteid = v.id
                                                            AND s.criteriaid = " . $criteria["id"] . ")
                                                        ),
                                                    0) AS total
                                                FROM `vote` AS v
                                                WHERE v.entryid = " . $entry["id"] . "") or die(mysql_error());
                        
                        while($row = mysql_fetch_array($res)){
                            array_push($scores, $row["total"]);
                        }
                    }
                }
                
                $this->writeEntry($entry["id"], $entry["name"], $entry["url"], $entry["totalScore"], $scores);
            }
        }
        
        $this->writeEnd();   
    }
    
    // Delegate methods --------------------------------------------------------
    
    /** \brief This is called when we are beginning to generate the entry table.
     */
    abstract function writeStart();
    
    /** \brief Called for writing an individual cell.
     * \param id The ID of the entry itself.
     * \param name The name of the entry.
     * \param url The URL of the entry.
     * \param overallScores The total sum of all the scores.
     * \param scores All the totals for all the criterion.
     */
    abstract function writeEntry($id, $name, $url, $overallScore, $scores);
    
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
    
    function writeEntry($id, $name, $url, $overallScore, $scores){
        
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
                    <th></th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Total Score</th>");
        
        foreach($this->getCriteria() as $crit){
            print("<th>" . htmlentities($crit["name"]) . "</th>");
        }
        
        print("</tr>");
    }
    
    function writeEntry($id, $name, $url, $overallScore, $scores){
        $allScores = $this->getAllTotalScores();
        if($overallScore == $allScores[0]){
            $badgeSource = "<img src='../badges/first.png' />";
        }
        else if($overallScore == $allScores[1]){
            $badgeSource = "<img src='../badges/second.png' />";
        }
        else if($overallScore == $allScores[2]){
            $badgeSource = "<img src='../badges/third.png' />";
        }
        else if($overallScore == $allScores[count($allScores) - 1]){
            $badgeSource = "<img src='../badges/last.png' />";
        }
        else    {
            $badgeSource = "<img src='../badges/blank.png' />";
        }
        
        print("<tr>
                <td>" . $badgeSource . "</td>
                <td>" . $name . "</td>
                <td>" . $url . "</td>
                <td>" . $overallScore . "</td>");
        
        foreach($scores as $score){
            print("<td>" . $score . "</td>");
        }
        
        print("<td>
                    <form>
                        <input type='submit' value='^' />
                        <input type='hidden' name='projectSet' value='" . htmlspecialchars($this->name, ENT_QUOTES) . "'>
                    </form>
                </td>
                <td>
                    <form>
                        <input type='submit' value='v' />
                        <input type='hidden' name='projectSet' value='" . htmlspecialchars($this->name, ENT_QUOTES) . "'>
                    </form>
                </td>
              </tr>");
    }
    
    function writeEnd(){
        print("</table>");
    }
    
}

/** \brief A subclass of Entry_Table that shows all the entries for voting on.
 */
class Voting_Entry_Table extends Entry_Table {
    // Constructor -------------------------------------------------------------    
    function __construct($name){
        parent::__construct($name, false);
        
        /*print('kitten');
        $this->name = $name;
        $this->criteria = DB_GetProjectSetCriteria($name); */
    }
    
    // Implemented for Entry_Table ---------------------------------------------
    function writeStart(){
        print('kitten');
        /*ECHO '
        <div id="votingForm">
            <form name="postVote" action="" method="post">';*/
    }
    
    function writeEntry($id, $name, $url, $overallScore, $scores){
        print('kitten');
        /* ECHO '
                <div id="project">
                    <h2><div id="projectUrl"><a href="' . $url . '">' . $url . '</a></div><div id="projectName">' . $name . '</div></h2>
                    <table>
                        <div id="sliderBox">';
                            foreach($this->getCriteria() as $j => $crit) {
                                echo '
                            <tr>
                                <td>' . htmlspecialchars($crit["name"]) . '</td>
                                <td>
                                    <input type="range" class="sliderBar" id="sliderBar' . $id . '.' . $j . '" name="p' . $id . '.' . $crit["name"]
                                        . '" value="0" min="-10" max="10" onchange="displaySliderValue(\'sliderValue' . $id . '.' . $j . '\', this.value)" />
                                    <span id="sliderValue' . $id . '.' . $j . '"><script>document.write(document.getElementById(\'sliderBar' . $id . '.' . $j . '\').value)</script></span>
                                </td>
                            </tr>';
                            }
                            echo '
                        </div>
                    </table>
                </div>'; */
    }
    
    function writeEnd(){
        print('kitten');
        /* ECHO '
                <table>
                    <tr>
                        <td><input type="submit" name="submit" /></td>
                    </tr>
                </table>
            </form>
        </div>'; */
    }
}

/// \}

?>

