<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

// Includes and Requires -------------------------------------------------------

// Variables -------------------------------------------------------------------
$projectSet = null;
$title = '';
$head_extra = null;

$title = $projectSet . ' Project Voting';

// Set additional head information
$head_extra = '<script src="../html5slider.js"></script>
        <script type="text/javascript">
            function displaySliderValue(elementId, value) {
                var elem = document.getElementById(elementId);
                elem.innerHTML = value;
            }
        </script>';

// Header Require --------------------------------------------------------------
require_once('../header.php');

// Header Overrides ------------------------------------------------------------
if (!$projectSet) {
    $projectSet = DB_GetCurrentProjectSetName();
    if(!$projectSet) {
        $projectSet = null;
    }
}

$votingTable = new Voting_Entry_Table($projectSet);
$votingTable->generate();

require_once('../footer.php')
?>