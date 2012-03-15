<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

// Includes and Requires -------------------------------------------------------
require_once('../config.php');
require_once(LAYOUT_PATH_ROOT . 'header_start.php');

// Definitions -----------------------------------------------------------------
define(PROJECT_NUMBER, 0);
define(CRITERIA_NUMBER, 1);

// Header Overrides ------------------------------------------------------------
if (!$projectSet) {
    $projectSet = DB_GetCurrentProjectSetName();
    if(!$projectSet) {
        $projectSet = null;
    }
}

// Variables -------------------------------------------------------------------
$title = '';
$head_extra = null;

$title = $projectSet . ' Project Voting';

// Set additional head information
$head_extra = '<script src="' . LAYOUT_PATH_WWW . 'html5slider.js"></script>
        <script type="text/javascript">
            function displaySliderValue(elementId, value) {
                var elem = document.getElementById(elementId);
                elem.innerHTML = value;
            }
        </script>';

// Header ----------------------------------------------------------------------
require_once(LAYOUT_PATH_ROOT . 'header_end.php');

$projectSetState = DB_GetProjectSetStates($projectSet);

if ($projectSetState["votingOpen"]) {
    if (isset($_POST[P_VOTE_ACTION]) && !isset($_COOKIE[$projectSet])) {
        // Variables
        $keys = array();
        $criteriaKeys = array();
        $criteriaValues = array();
        $values = array();
        $votes_temp = array();
        $votes = array();
        
        // Actions
        setcookie($projectSet, 'true', time()+(60*60*24*30), '/vote/');
        $projectIDs = DB_GetAllEntryIDsInProjectSet($projectSet);
        
        foreach($_POST as $key => $value) {
            $voteInfo = explode('_', $key);
            
            if (in_array($voteInfo[PROJECT_NUMBER], $projectIDs)) {
                array_push($keys, $voteInfo[PROJECT_NUMBER]);
            }
        }
        
        for ($i = 0; $i < count($keys); $i++) {
            foreach($_POST as $key => $value) {
                $voteInfo = explode('_', $key);
                
                if ($voteInfo[PROJECT_NUMBER] && is_numeric($voteInfo[PROJECT_NUMBER])
                    && $voteInfo[PROJECT_NUMBER] == $keys[$i]
                    && $voteInfo[CRITERIA_NUMBER] && is_numeric($voteInfo[CRITERIA_NUMBER])) {
                    array_push($criteriaKeys, $voteInfo[CRITERIA_NUMBER]);
                    array_push($criteriaValues, $value);
                }
            }
            
            $values = array_combine($criteriaKeys, $criteriaValues);
            $votes[$keys[$i]] = $values;
        }
        
        DB_VoteForProjectSet($projectSet, $votes);
        
        die("Thanks for voting!");
    }
    
    $votingTable = new Voting_Entry_Table($projectSet);
    $votingTable->generate();
} else {
    echo 'This project set isn\'t open for voting. Please go back to the archive.';
}

require_once(LAYOUT_PATH_ROOT . 'footer.php')
?>