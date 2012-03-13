<?php

/** \file params.php
 * \brief This file defines a lot of parameters (GET and POST names) that can
 * be sent to different pages and certain arguments for them.
 * \defgroup params GET/POST Parameters
 * \{
 */

// Admin index -----------------------------------------------------------------

/** \brief This defines what project set is being operated on or created.
 *
 * Can be set in POST or GET.
 */
define(P_ADMIN_PROJ_SET, "projectSet");

/** \brief This defines what action the page is requesting if it is set.
 *
 * Should be sent in POST.
 */
define(P_ADMIN_ACTION, "action");

/** \brief This value is given to the P_ADMIN_ACTION parameter when you want to
 * change the state of the given page.
 *
 * This should be sent via POST.
 */
define(PV_ADMIN_ACTION_STATE_CHANGE, "stateChange");

/** \brief On this action, we create a new project set whose name is defined by
 * the projectSet parameter.
 */
define(PV_ADMIN_ACTION_NEW_PROJECT_SET, "newProjectSet");

/** \brief On this action, we create a new entry whose name is given by the name
 * parameter.
 *
 * This should be sent via POSt.
 */
define(PV_ADMIN_ACTION_NEW_ENTRY, "newEntry");

/** \brief This parameter is passed in POST when you want to create a new
 * entry to the project set.
 */
define(P_NEW_ENTRY_NAME, "name");

define(P_ADMIN_STATE_ARCHIVED, "archived");
define(P_ADMIN_STATE_RESULTS_VISIBLE, "resultsVisible");
define(P_ADMIN_STATE_VOTING_OPEN, "votingOpen");

// New set ---------------------------------------------------------------------
define(P_NEWSET_PREV_PROJ_SET, "prevProjectSet");

/// \}

?>