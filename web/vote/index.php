<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

// Includes and Requires -------------------------------------------------------
require_once('../config.php');
require_once(LAYOUT_PATH_ROOT . 'header_start.php');

// Definitions -----------------------------------------------------------------
define('PROJECT_NUMBER', 0);
define('CRITERIA_NUMBER', 1);
define('MAX', 10);
define('MIN', -10);

// Header Overrides ------------------------------------------------------------
if (!$projectSet) {
    $projectSet = DB_GetCurrentProjectSetName();
    if(!$projectSet) {
        $projectSet = null;
    }
}

// Variables -------------------------------------------------------------------
$projectSetState = DB_GetProjectSetStates($projectSet);
$title = $projectSet . ' Project Voting';
$head_extra = null;

// Cookie
if ($projectSetState["votingOpen"] && isset($_POST[P_VOTE_ACTION]) && (isset($_POST["projectSet"]) && !isset($_COOKIE[$_POST["projectSet"]]))) {
    setCookieInfo('projectSetViewed', $_POST['projectSet'], time()+(60*60*24*30), '/' . COOKIE_PATH . 'vote/');
}

// Set additional head information
$head_extra = '<!-- <script src="' . LAYOUT_PATH_WWW . 'html5slider.js"></script> -->
        <script type="text/javascript">
            function displaySliderValue(elementId, value) {
                var elem = document.getElementById(elementId);
                elem.innerHTML = value;
            }
        </script>';

// Header ----------------------------------------------------------------------
require_once(LAYOUT_PATH_ROOT . 'header_end.php');

if ($projectSetState["votingOpen"] && !isCookieSet('projectSetViewed', $projectSet)) {
    if (isset($_POST[P_VOTE_ACTION])) {
        // Variables
        $projectSet = $_POST["projectSet"];
        $keys = array();
        $criteriaKeys = array();
        $criteriaValues = array();
        $values = array();
        $votes_temp = array();
        $votes = array();
        
        // Actions
        $projectIDs = DB_GetAllEntryIDsInProjectSet($projectSet);
        
        foreach($_POST as $key => $value) {
            $voteInfo = explode('_', $key);
            
            if (in_array($voteInfo[PROJECT_NUMBER], $projectIDs)) {
                array_push($keys, $voteInfo[PROJECT_NUMBER]);
            }
        }
        
        for ($i = 0; $i < count($keys); $i++) {
            foreach($_POST as $key => $value) {
                if ($value > MAX) {
                    $value = MAX;
                } else if ($value < MIN) {
                    $value = MIN;
                }
                
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
        
        echo 'Thanks for voting!';
    } else {
        $votingTable = new Voting_Entry_Table($projectSet);
        $votingTable->generate();
    }
}
else if(isCookieSet('projectSetViewed', $projectSet) || (isset($_POST["projectSet"]) && isCookieSet('projectSetViewed', $_POST["projectSet"]))) {
    echo 'Thanks for voting!';
}
else {
    echo 'This year\'s TFM isn\'t open for voting. Please go back to the <a style="padding: 0;" href="../index.php">archives</a>.';
}

require_once(LAYOUT_PATH_ROOT . 'footer.php')
?>