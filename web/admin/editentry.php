<?php

/** \file editentry.php
 * \brief A file to edit a new entry or a currently existing entry.
 */

require_once('../header_start.php');

$title = "Edit Entry";

require_once('../header_end.php');

?>
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td> Name: </td>
                    <td> <input id="nameField" type="text" name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_NAME, ENT_QUOTES)) ?>" /> </td>
                </tr>
                <tr>
                    <td> URL: </td>
                    <td> <input id="nameField" type="text" name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_URL, ENT_QUOTES)) ?>" /> </td>
                </tr>
            </table>
            <input type="checkbox" name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_SENSITIVE, ENT_QUOTES)) ?>" />Sensitive</input>
            <br/>
            <textarea name="<?php print(htmlspecialchars(P_ADMIN_ENTRY_DESCRIPTION, ENT_QUOTES)) ?>"></textarea>
            <hr/>
            <a href="index.php">Cancel</a>
            <input type="hidden" name="<?php print(htmlspecialchars(P_ADMIN_ACTION, ENT_QUOTES)) ?>" value="<?php print(htmlspecialchars(PV_ADMIN_ACTION_NEW_ENTRY, ENT_QUOTES)) ?>" />
            <input type="hidden" value="<?php print(htmlspecialchars($projectSet, ENT_QUOTES)) ?>" name="<?php print(htmlspecialchars(P_ALL_PROJ_SET, ENT_QUOTES)) ?>" />
            <input type="submit" value="Done" />
        </form>

<?php

require_once("../footer.php");

?>