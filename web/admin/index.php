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

// Variables -------------------------------------------------------------------
$projectSet = null;
$title = "";
$states = array("resultsVisible" => false, "votingOpen" => false, "archived" => false);

// Generation ------------------------------------------------------------------
DB_Start();

// Get current project set
if(isset($_GET["projectSet"]) && DB_GetProjectSetExists($_GET["projectSet"])){
    $projectSet = $_GET["projectSet"];
}
else{
    $projectSet = DB_GetCurrentProjectSetName();
    if(!$projectSet){
        $projectSet = null;
    }
}

$title = htmlentities($projectSet) . " > Administration";
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
                <form action="index.php">
                    <select name="projectSet">
                        
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
                    <input type="submit" value="New Project Set" />
                </form>
            </div>
        </div>
        
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
    </body>
</html>

<?php

DB_End();

?>