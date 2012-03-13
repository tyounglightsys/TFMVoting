<?php

/** \file index.php
 * \brief This file is the administrative view.
 *
 * This file takes the following GET parameters: projectSet - This is the
 * current group of entries to work on, which will default to the most recent
 * if none is given.
 */

// Requires --------------------------------------------------------------------
require_once("../config.php");
require_once("../components.php");
require_once("../functions.php");
require_once("../params.php");

// Processing ------------------------------------------------------------------
DB_Start();

if(isset($_POST[P_ADMIN_ACTION])){
    switch($_POST[P_ADMIN_ACTION]){
        case PV_ADMIN_ACTION_STATE_CHANGE:
            if($projectSet){
                DB_SetProjectSetStates($projectSet,
                                       $_POST[P_ADMIN_STATE_VOTING_OPEN],
                                       $_POST[P_ADMIN_STATE_RESULTS_VISIBLE],
                                       $_POST[P_ADMIN_STATE_ARCHIVED]);
            }
            break;
        case PV_ADMIN_ACTION_NEW_PROJECT_SET:
            if(!$projectSet){
                DB_CreateProjectSet($projectSet);
            }
            break;
        case PV_ADMIN_ACTION_NEW_ENTRY:
            if($projectSet){
                DB_CreateEntry($projectSet, $entryName, $entryURL, $entryDescription, $entryPrivate);
            }
            break;
    }
}

// Generation ------------------------------------------------------------------
$title = $projectSet . " > Administration";
$states = DB_GetProjectSetStates($projectSet);

?>

<html>
    <head>
        <title> <?php print($title) ?> </title>
        <link href="../style.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        
        <div id="header">
            <h1> <?php print($title) ?></h1>
            <div id="projectSetActions"> 
                <form action="index.php" method="get">
                    <select name="<?php print(P_ADMIN_PROJ_SET); ?>">
                        
                        <?php
                            // Generate list of projects
                            $names = DB_GetAllProjectSetNames();
                            foreach($names as $name){
                                printf('<option value="%s" %s>%s</option>',
                                       htmlspecialchars($name, ENT_QUOTES),
                                       ($name == $projectSet) ? "selected='true'" : "",
                                       htmlentities($name));
                            }
                        ?>
    
                    </select>
                    <input type="submit" value="Change Project Set" />
                </form>
                <form action="newset.php">
                    <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)); ?>" name="<?php print(P_NEWSET_PREV_PROJ_SET)?>" />
                    <input type="submit" value="New Project Set" />
                </form>
            </div>
        </div>
        
        <h2> Status </h2>
        <form action="">
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
                    <td><input type="checkbox" name="<?php print(P_ADMIN_STATE_SHOWING_RESULTS); ?>"
                    
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
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)); ?>" name=<?php print(P_ADMIN_PROJ_SET) ?> />
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
    </body>
</html>

<?php

DB_End();

?>