<?php

/** \file index.php
 * \brief This shows the archives of the application.
 */

// Includes and Requires -------------------------------------------------------
require_once('header_start.php');

// Variables -------------------------------------------------------------------
$title = '';
$head_extra = null;
$div_header_extra = null;

$title = 'Archives';

require_once('header_end.php');
?>
        <?php
        if(!isset($_GET["projectSetName"])){
            ?>
            <h2>Archives</h2>
            <?php
                $archiveTable = new Archive_Entry_Table();
                $archiveTable->generate();
            ?>
            <table>
                <tr>
                    <th> Project Name </th>
                    <th> Link </th>
                </tr>
                <tr>
                    <td> Reallynotaproject </td>
                    <td> <a href="">View</a> </td>
                </tr>
            </table>
            <?php
        }
        else{
            ?>
            <h2> Specific Project Set </h2>
            <p>
                asdfasdfg
            </p>
            <?php
        }
        ?>
        
    </body>
</html>