<?php

/** \file editentry.php
 * \brief A file to edit a new entry or a currently existing entry.
 */

require_once('../config.php');
require_once(LAYOUT_PATH_ROOT . 'header_start.php');

$title = "Edit Entry";
$description = "";
$name = "";
$url = "http://";
$sensitive = false;
$new = true;
$id = 0;

if(isset($_POST[P_NEWEDIT_ENTRY_ID])){
    $new = false;
    $id = (int)$_POST[P_NEWEDIT_ENTRY_ID];
    if($entryData = DB_GetEntryData($id)){
        $name = $entryData["name"];
        $sensitive = (bool)$entryData["sensitive"];
        $url = $entryData["url"];
        $description = $entryData["description"];
    }
}


require_once(LAYOUT_PATH_ROOT . 'header_end.php');

?>
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td> Name: </td>
                    <td> <input id="nameField" type="text" name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_NAME, ENT_QUOTES)) ?>" value="<?php print(htmlspecialchars($name, ENT_QUOTES)) ?>" /> </td>
                </tr>
                <tr>
                    <td> URL: </td>
                    <td> <input id="nameField" type="text" name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_URL, ENT_QUOTES)) ?>" value="<?php print(htmlspecialchars($url, ENT_QUOTES)) ?>"/> </td>
                </tr>
            </table>
            
            <input type="checkbox" name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_SENSITIVE, ENT_QUOTES)) ?>"
                <?php
                    if($sensitive){
                        echo("checked='true'");
                    }
                ?>/>Sensitive</input>
            
            <p>
                Description:
            </p>
            <textarea name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_DESCRIPTION, ENT_QUOTES)) ?>"><?php echo(htmlentities($description))?></textarea>
            
            <?php
                if(!$new){
                    print("<input type='hidden' value='" . (int)$id . "' name='" . htmlspecialchars(P_ADMIN_ENTRY_ID, ENT_QUOTES) . "'/>");
                }
            ?>
            
            <hr />
            
            <input type="hidden" name="<?php print(htmlspecialchars(P_ADMIN_ACTION, ENT_QUOTES)) ?>" value="<?php print(htmlspecialchars(PV_ADMIN_ACTION_NEW_ENTRY, ENT_QUOTES)) ?>" />
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)) ?>" name="<?php print(htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES)) ?>" />
            <input type="submit" value="Done" />
        </form>
        
        <!-- Cancel form -->
        <form action="index.php" method="get">
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)) ?>" name="<?php print(htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES)) ?>" />
            <input type="submit" value="Cancel" />
        </form>

<?php

require_once(LAYOUT_PATH_ROOT . 'footer.php');

?>