<?php

/** \file index.php
 * \brief This file is the administrative view.
 *
 * This file takes the following GET parameters: projectSet - This is the
 * current group of entries to work on, which will default to the most recent
 * if none is given.
 */

// Includes and Requires -------------------------------------------------------
require_once('../header_start.php');

// Processing ------------------------------------------------------------------
if(isset($_POST[P_ADMIN_ACTION])){
    switch($_POST[P_ADMIN_ACTION]){
        case PV_ADMIN_ACTION_STATE_CHANGE:
            if($projectSet){
                DB_SetProjectSetStates($projectSet,
                                       $_POST[P_ADMIN_STATE_VOTING_OPEN] ? 1 : 0,
                                       $_POST[P_ADMIN_STATE_RESULTS_VISIBLE] ? 1 : 0,
                                       $_POST[P_ADMIN_STATE_ARCHIVED] ? 1 : 0);
            }
            break;
        case PV_ADMIN_ACTION_NEW_PROJECT_SET:
            if(!$projectSet){
                DB_CreateProjectSet($_POST[P_ALL_PROJ_SET]);
            }
            break;
        case PV_ADMIN_ACTION_NEW_ENTRY:
            if($projectSet){
                DB_CreateEntry($projectSet, $entryName, $entryURL, $entryDescription, $entryPrivate);
            }
            break;
    }
}

if (!$projectSet) {
    $projectSet = DB_GetCurrentProjectSetName();
    if(!$projectSet) {
        $projectSet = null;
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
                    <input type="submit" value="Change Project Set" />
                </form>
                <form action="newset.php">
                    <input type="hidden" value="' . htmlspecialchars($projectSet, ENT_QUOTES) . '" name="' . htmlspecialchars(P_NEWSET_PREV_PROJ_SET, ENT_QUOTES) . '"/>
                    <input type="submit" value="New Project Set" />
                </form>
            </div>';

// Header ----------------------------------------------------------------------
require_once('../header_end.php');
?>
        <h2> Status </h2>
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td>Open:</td>
                    <td><input type="checkbox" name="<?php print(P_ADMIN_STATE_VOTING_OPEN); ?>"
                        
                        <?php
                            // Show the status for the votingOpen category
                            if($states["votingOpen"]){
                                print("checked='yes'");
                            }
                        ?>"/>
                        
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
                        ?>"/>
                        
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
                        ?>"/>
                    
                    </td>
                </tr>
            </table>
            <input type="hidden" name="<?php print(htmlspecialchars(P_ADMIN_ACTION, ENT_QUOTES)) ?>" value="<?php print(htmlspecialchars(PV_ADMIN_ACTION_STATE_CHANGE, ENT_QUOTES)) ?>" />
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)) ?>" name=<?php print(P_ALL_PROJ_SET) ?> />
            <input type="submit" value="Update State" />
        </form>

        <h2>Entries</h2>
        <?php
            $et = new Admin_Entry_Table($projectSet);
            $et->generate();
        ?>
        <form action="editentry.php">
            <input type="submit" value="Add New Entry" />
        </form>
<?php require_once('../footer.php') ?>