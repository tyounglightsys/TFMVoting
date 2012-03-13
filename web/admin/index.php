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

// Header Overrides ------------------------------------------------------------
if (!$projectSet) {
    $projectSet = DB_GetCurrentProjectSetName();
    if(!$projectSet) {
        $projectSet = null;
    }
}

// Variables -------------------------------------------------------------------
$title = "";
$states = array("resultsVisible" => false, "votingOpen" => false, "archived" => false);
$header_div_extra = null;

$title = htmlentities($projectSet) . " > Administration";
$states = DB_GetProjectSetStates($projectSet);

// Set additional header div information
$header_div_extra = '<div id="projectSetActions"> 
                <form action="index.php">
                    <select name="projectSet">
                        ';

// Generate list of projects
$names = DB_GetAllProjectSetNames();
foreach($names as $name){
    $header_div_extra .= '<option value="'
        . htmlspecialchars($name, ENT_QUOTES)
        . '" ' . ($name == $projectSet) ? "selected=\'true\'" : ""
        . '>' . htmlentities($name) . '</option>';
}

$header_div_extra .= '
                    </select>
                    <input type="submit" value="Change Project Set" />
                </form>
                <form action="newset.php">
                    <input type="submit" value="New Project Set" />
                </form>
            </div>';

// Header ----------------------------------------------------------------------
require_once('../header_end.php');
?>
        <h2> Status </h2>
        <form action="">
            <table>
                <tr>
                    <td>Open:</td>
                    <td><input type="checkbox" name="votingOpen"
                        
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
                    <td><input type="checkbox" name="showingResults" 
                    
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
                    <td><input type="checkbox" name="archived"
                    
                        <?php
                            // Show the status for the archived category
                            if($states["archived"]){
                                print("checked='yes'");
                            }
                        ?>"/>
                    
                    </td>
                </tr>
            </table>
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)); ?>" name="projectSet" />
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