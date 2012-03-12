<?php

/** \file components.php
 * \brief This file defines the major GUI components used in the system.
 * \defgroup comp GUI Components
 * \{
 */

require_once("functions.php");

/** \brief The base class for a component that shows all entries in a project
 * set.
 */
class Entry_Table{
    
    function __construct($name){
        $this->name = $name;
        
    }
    
}

/** \brief A subclass of Entry_Table that displays a table specifically meant
 * for showing an archived project set.
 */
class Archive_Entry_Table extends Entry_Table{
    
}

/** \brief This Entry_Table subclass shows all the data the admin needs to edit
 * the entries in a project set except for adding a new entry.
 */
class Admin_Entry_Table extends Entry_Table{
    
}

/** \brief A subclass of Entry_Table that shows all the entries for voting on.
 */
class Voting_Entry_Table extends Entry_Table{
    
}

/// \}

?>

