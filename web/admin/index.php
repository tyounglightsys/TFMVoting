<?php

/** \file index.php
 * \brief This file is the administrative view.
 *
 * This file takes the following GET parameters: projectSet - This is the
 * current group of entries to work on, which will default to the most recent
 * if none is given.
 */

// Includes and Requires -------------------------------------------------------
require_once('../config.php');
require_once(LAYOUT_PATH_ROOT . 'header_start.php');

// Keep errors from filling the error-log by making these entries if they do not exist
if(!isset($_POST[P_ADMIN_STATE_VOTING_OPEN])) $_POST[P_ADMIN_STATE_VOTING_OPEN]=1;
if(!isset($_POST[P_ADMIN_STATE_RESULTS_VISIBLE])) $_POST[P_ADMIN_STATE_RESULTS_VISIBLE]=1;
if(!isset($_POST[P_ADMIN_STATE_ARCHIVED])) $_POST[P_ADMIN_STATE_ARCHIVED]=1;
if(!isset($_POST[P_ALL_PROJ_SET])) $_POST[P_ALL_PROJ_SET]="";
if(!isset($_POST[P_ADMIN_ENTRY_NAME])) $_POST[P_ADMIN_ENTRY_NAME]="";
if(!isset($_POST[P_ADMIN_ENTRY_URL])) $_POST[P_ADMIN_ENTRY_URL]="";
if(!isset($_POST[P_ADMIN_ENTRY_DESCRIPTION])) $_POST[P_ADMIN_ENTRY_DESCRIPTION]="";
if(!isset($_POST[P_ADMIN_ENTRY_SENSITIVE])) $_POST[P_ADMIN_ENTRY_SENSITIVE]=0;

// Processing ------------------------------------------------------------------
if(isset($_POST[P_ADMIN_ACTION])){
    switch($_POST[P_ADMIN_ACTION]){
        case PV_ADMIN_ACTION_STATE_CHANGE:
            if($projectSet !== null){
                DB_SetProjectSetStates($projectSet,
                                       $_POST[P_ADMIN_STATE_VOTING_OPEN] ? 1 : 0,
                                       $_POST[P_ADMIN_STATE_RESULTS_VISIBLE] ? 1 : 0,
                                       $_POST[P_ADMIN_STATE_ARCHIVED] ? 1 : 0);
            }
            break;
        case PV_ADMIN_ACTION_NEW_PROJECT_SET:
            if($projectSet === null){
                DB_CreateProjectSet($_POST[P_ALL_PROJ_SET], $CRITERIA_DEFAULT);
            }
            break;
        case PV_ADMIN_ACTION_NEW_ENTRY:
            if($projectSet !== null){
                if(isset($_POST[P_ADMIN_ENTRY_ID])){
                    $entries = DB_GetAllEntryIDsInProjectSet($projectSet);
                    if(in_array((int)$_POST[P_ADMIN_ENTRY_ID], $entries)){
                        DB_EditEntry((int)$_POST[P_ADMIN_ENTRY_ID],
                                    (string)$_POST[P_ADMIN_ENTRY_NAME],
                                    (string)$_POST[P_ADMIN_ENTRY_URL],
                                    (string)$_POST[P_ADMIN_ENTRY_DESCRIPTION],
                                    $_POST[P_ADMIN_ENTRY_SENSITIVE] ? 1 : 0);
                    }
                }
                else{
                    DB_CreateEntry($projectSet,
                               (string)$_POST[P_ADMIN_ENTRY_NAME],
                               (string)$_POST[P_ADMIN_ENTRY_URL],
                               (string)$_POST[P_ADMIN_ENTRY_DESCRIPTION],
                               $_POST[P_ADMIN_ENTRY_SENSITIVE] ? 1 : 0);
                }
            }
            break;
        case PV_ADMIN_ACTION_MOVE_ENTRY:
            if($projectSet !== null){
                $entries = DB_GetAllEntryIDsInProjectSet($projectSet);
                if(in_array((int)$_POST[P_ADMIN_ENTRY_ID], $entries)){
                    DB_MoveEntry($projectSet,
                                 (int)$_POST[P_ADMIN_ENTRY_ID],
                                 (int)$_POST[P_ADMIN_MOVE_DIRECTION]);
                }
            }
            break;
        case PV_ADMIN_ACTION_DELETE_ENTRY:
            if($projectSet !== null && isset($_POST[P_ADMIN_ENTRY_ID])){
                $entries = DB_GetAllEntryIDsInProjectSet($projectSet);
                if(in_array((int)$_POST[P_ADMIN_ENTRY_ID], $entries)){
                    DB_DeleteEntry((int)$_POST[P_ADMIN_ENTRY_ID]);
                }
            }
            break;
	case PV_ADMIN_ACTION_QUERY_DELETE_PROJECT_SET:
	    if($projectSet !== null){
		echo "Do you really want to unrevocably delete $projectSet with no chance of recovering?<br>";
		echo "
		<table><td>
		<form method='post' action='index.php'>
		    <input title='Really delete this Project Set' type='submit' value='Yes' />
		    <input type='hidden' value='" . htmlspecialchars($projectSet, ENT_QUOTES) . "' name='" . htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES) . "'/>
		    <input type='hidden' name='" . htmlspecialchars(P_ADMIN_ACTION, ENT_QUOTES) . "' value='" . htmlspecialchars(PV_ADMIN_ACTION_DELETE_PROJECT_SET, ENT_QUOTES) . "'> 
		</form>
		</td><td>
		<form method='post' action='index.php'>
		    <input title='Oops!  Do not delete.  Just return me to the menu.' type='submit' value='NO!' />
		</form>
		</td>
		</table>
		";
		exit();
	    }
            break;
	case PV_ADMIN_ACTION_DELETE_PROJECT_SET:
	    /* TCY - Delete an entire project set if one is specified
	    */
	    if($projectSet !== null){
		//echo "We would delete the project set: $projectSet<br>";
		DB_DeleteProjectSet($projectSet);
		echo "Deleted $projectSet<br>\n";
		unset ($projectSet); //Forget it now so we make the list.
	    }
	    break;
    }
}

if (!isset($projectSet) || $projectSet === null) {
    $projectSet = DB_GetCurrentProjectSetName();
    if($projectSet === false) {
        header("Location: newset.php");
        exit();
    }
    else {
	//TCY - Here we list all the project sets and stuff.
	$title = " Administration> List Sets";
	require_once(LAYOUT_PATH_ROOT . 'header_end.php');

	echo '
            <h2>Archives > Project Set Listings</h2>
            <div id="projectSetListing">';

	$names_states = DB_GetAllProjectSetStates();
	foreach($names_states as $i => $name) {
	    echo "\n<table><tr>";
	    echo "<td>
		<form method='post' action='index.php'>
		    <input title='Delete this Project Set' type='submit' value='Delete' />
		    <input type='hidden' value='" . htmlspecialchars($name["name"], ENT_QUOTES) . "' name='" . htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES) . "'/>
		    <input type='hidden' name='" . htmlspecialchars(P_ADMIN_ACTION, ENT_QUOTES) . "' value='" . htmlspecialchars(PV_ADMIN_ACTION_QUERY_DELETE_PROJECT_SET, ENT_QUOTES) . "'> 
		</form>
		</td>
	    ";

	    echo "<td>";
	    echo '<h3><a href="index.php?projectSet='
	    . htmlspecialchars($name["name"], ENT_QUOTES) . '">'
	    . htmlentities($name["name"], ENT_QUOTES) . '</a>';
	    if ($name["archived"]) {
		echo ' archived';
	    }
	    if ($name["votingOpen"]) {
		echo ' VotingOpen';
	    }
	    if ($name["resultsVisible"]) {
		echo ' ResultsVisible';
	    }
	    echo "</h3>\n";
	    echo "</td></tr></table><br>\n";
	}

	echo '</div>';


	require_once(LAYOUT_PATH_ROOT . 'footer.php');
	exit();
    }
}

// Generation ------------------------------------------------------------------
$title = $projectSet . " > Administration";
$states = DB_GetProjectSetStates($projectSet);
$names = DB_GetAllProjectSetNames();


// Set additional header div information
$div_header_extra ='<div id="projectSetActions"> 
                    <form action="index.php">
                    <select name="projectSet">';

// Generate list of projects
foreach($names as $name){
    $div_header_extra .= '<option value="'
        . htmlspecialchars($name, ENT_QUOTES)
        . '" ' . (($name == $projectSet) ? "selected='true'" : "")
        . '>' . htmlentities($name) . '</option>';
}

// Finish off extra header info
$div_header_extra .= '
                    </select>
                    <input type="submit" value="Change Project Set" title="Choose a project set from the drop-down and open that project when this button is clicked."/>
                </form>
		<table align=right><td>
                <form action="index.php">
                    <input type="submit" value="Back" title="Go back to the list of project sets."/>
                </form>
		</td><td>
                <form action="newset.php">
                    <input type="hidden" value="' . htmlspecialchars($projectSet, ENT_QUOTES) . '" name="' . htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES) . '"/>
                    <input type="submit" value="New Project Set" title="Go to a page to create a new project set"/>
                </form>
		</td></table>
            </div>';

// Header ----------------------------------------------------------------------
require_once(LAYOUT_PATH_ROOT . 'header_end.php');
?>
        <h4>
            <a href="../vote/index.php?projectSet=<?php print($projectSet) ?>">Vote on this TFM</a>
            <a href="../index.php?projectSet=<?php print($projectSet) ?>">Go to this TFM's archive</a>
            <a href="../index.php">Go to the general archive listing</a>
            <a href="doc.php" TARGET="doc_window">Admin Documentation</a>
        </h4>
        <h2> Status </h2>
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td>Open For Voting:</td>
                    <td><input type="checkbox" name="<?php print(P_ADMIN_STATE_VOTING_OPEN); ?>"
                        
                        <?php
                            // Show the status for the votingOpen category
                            if($states["votingOpen"]){
                                print("checked='yes'");
                            }
                        ?>
			title="Whether to allow people to vote for this project."
			/>
                        
                    </td>
                </tr>
                <tr>
                    <td>Showing Results:</td>
                    <td><input type="checkbox" name="<?php print(P_ADMIN_STATE_RESULTS_VISIBLE); ?>"
                    
                        <?php
                            // Show the status for the resultsVisible category
                            if($states["resultsVisible"]){
                                print("checked='yes'");
                            }
                        ?>
			title="When looking at the projects, when archived or as admin, show the current vote tallys and ranking."
			/>
                        
                    </td>
                </tr>
                <tr>
                    <td>Archived: </td>
                    <td><input type="checkbox" name="<?php print(P_ADMIN_STATE_ARCHIVED); ?>"
                    
                        <?php
                            // Show the status for the archived category
                            if($states["archived"]){
                                print("checked='yes'");
                            }
                        ?>
			title="When Archived, this project set shows up as part of the list of projects that normal people see when they go to index.html.  Archived items can still be voted on, if they are open for voting."
			/>
                    
                    </td>
                </tr>
            </table>
            <input type="hidden" name="<?php print(htmlspecialchars(P_ADMIN_ACTION, ENT_QUOTES)) ?>" value="<?php print(htmlspecialchars(PV_ADMIN_ACTION_STATE_CHANGE, ENT_QUOTES)) ?>" />
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)) ?>" name="<?php print(htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES)) ?>" />
            <input type="submit" value="Update State" />
        </form>
	<br>

        <h2>Entries</h2>
        <?php
            $et = new Admin_Entry_Table($projectSet);
            $et->generate();
        ?>
        <form action="editentry.php">
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)) ?>" name="<?php print(htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES))?>"/>
            <input type="submit" value="Add New Entry" />
        </form>
<?php require_once(LAYOUT_PATH_ROOT . 'footer.php') ?>
