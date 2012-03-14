<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

// Includes and Requires -------------------------------------------------------
require_once('../config.php');
require_once(LAYOUT_PATH_ROOT . 'header_start.php');

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
$head_extra = '<script src="' . $layout_path_www . 'html5slider.js"></script>
        <script type="text/javascript">
            function displaySliderValue(elementId, value) {
                var elem = document.getElementById(elementId);
                elem.innerHTML = value;
            }
        </script>';

// Header ----------------------------------------------------------------------
require_once($layout_path_root . 'header_end.php');

$votingTable = new Voting_Entry_Table($projectSet);
$votingTable->generate();

require_once($layout_path_root . 'footer.php')
?>