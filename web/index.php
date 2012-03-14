<?php

/** \file index.php
 * \brief This shows the archives of the application.
 */

// Includes and Requires -------------------------------------------------------
require_once('layout/header_start.php');

// Variables -------------------------------------------------------------------
$title = '';
$head_extra = null;
$div_header_extra = null;

$title = 'Archives';

require_once('layout/header_end.php');

$archiveTable = new Archive_Entry_Table();
$archiveTable->generate();
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

include('layout/footer.php');