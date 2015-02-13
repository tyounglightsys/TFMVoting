<?php

/** \file index.php
 * \brief This shows the archives of the application.
 */

// Includes and Requires -------------------------------------------------------
require_once('config.php');
/*die($layout_path_root . 'header_start.php' . ' exists: '
    . (file_exists($layout_path_root . 'header_start.php') ? "true" : "false"));*/
require_once(LAYOUT_PATH_ROOT . 'header_start.php');

// Header Overrides ------------------------------------------------------------

// Variables -------------------------------------------------------------------
$title = '';
$head_extra = null;
$div_header_extra = null;

$title = 'ICCM Europe\'s Technology for Mission Contest';

require_once(LAYOUT_PATH_ROOT . 'header_end.php');

$allreadyvoted = ($_COOKIE['projectSetViewed']!='' ? true : false); 

if (!isset($projectSet) || $projectSet === null) {
    $projectSet = DB_GetCurrentProjectSetName();
    $states = DB_GetProjectSetStates($projectSet);
    
    echo '
            <h2>' . htmlentities($projectSet) . ' > Projects</h2>';
    
	if ($states["votingOpen"] && !$allreadyvoted) {
	    echo "\n";
	    echo'<div class="round-button rotate"><div class="round-button-circle"><a href="vote/index.php?projectSet='
	    . htmlspecialchars($projectSet, ENT_QUOTES) . '">'
	    . 'Click here to vote' . '</a></div></div>';
	    echo "\n";
	}

    echo '<div id="content">';
    $archiveTable = new Archive_Entry_Table($projectSet);
    $archiveTable->generate();
    echo '</div>';
    
    
}
else if ($projectSet) {
    $states = DB_GetProjectSetStates($projectSet);
    echo '    <br><a href="index.php">Back</a><br>';
    
    if ($states["archived"]) {
        echo '
            <h2>' . htmlentities($projectSet) . ' > Projects</h2>';

	if ($states["votingOpen"]) {
	    echo "\n";
	    echo'<a href="vote/index.php?projectSet='
	    . htmlspecialchars($projectSet, ENT_QUOTES) . '">'
	    . 'vote on ' . htmlentities($projectSet, ENT_QUOTES) . '</a><br><br>';
	    echo "\n";
	}

        $archiveTable = new Archive_Entry_Table($projectSet);
        $archiveTable->generate();
    } else {
        $projectSet = null;
    }
    echo "\n";
    echo '    <br><a href="index.php">Back</a><br>';
}

if (!$projectSet) {
    echo '
            <h2>Archives > Project Set Listings</h2>
            <div id="projectSetListing">';
    
    $names_states = DB_GetAllProjectSetStates();
    foreach($names_states as $i => $name) {
        
        if ($name["archived"]) {
            echo '
                <h3><a href="index.php?projectSet='
            . htmlspecialchars($name["name"], ENT_QUOTES) . '">'
            . htmlentities($name["name"], ENT_QUOTES) . '</a></h3>';
        }
    }
    

    
    echo '
            </div>';
}


include(LAYOUT_PATH_ROOT . 'footer.php');
