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

$title = 'Archives';

require_once(LAYOUT_PATH_ROOT . 'header_end.php');

if ($projectSet) {
    $states = DB_GetProjectSetStates($projectSet);
    
    if ($states["archived"]) {
        echo '
            <h2>' . htmlentities($projectSet) . ' > Projects</h2>';

        $archiveTable = new Archive_Entry_Table($projectSet);
        $archiveTable->generate();
    } else {
        $projectSet = null;
    }
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
?>
            <!--<table>
                <tr>
                    <th> Project Name </th>
                    <th> Link </th>
                </tr>
                <tr>
                    <td> Reallynotaproject </td>
                    <td> <a href="">View</a> </td>
                </tr>
            </table>-->
<?php
/*        }
        else{
            ?>
            <h2> Specific Project Set </h2>
            <p>
                asdfasdfg
            </p>
            <?php
        }
        ?>*/

include(LAYOUT_PATH_ROOT . 'footer.php');
