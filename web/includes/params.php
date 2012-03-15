<?php

/** \file params.php
 * \brief This file defines a lot of parameters (GET and POST names) that can
 * be sent to different pages and certain arguments for them.
 * \defgroup params GET/POST Parameters
 * \{
 */

// All pages in general --------------------------------------------------------
define(P_ALL_PROJ_SET, "projectSet");

// Admin index -----------------------------------------------------------------

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
 * This should be sent via POST.
 */
define(PV_ADMIN_ACTION_NEW_ENTRY, "newEntry");

define(PV_ADMIN_ACTION_MOVE_ENTRY, "moveEntry");

/** \brief This parameter is passed in POST when you want to create a new
 * entry to the project set.
 */
define(P_NEW_ENTRY_NAME, "name");

define(P_ADMIN_STATE_ARCHIVED, "archived");
define(P_ADMIN_STATE_RESULTS_VISIBLE, "resultsVisible");
define(P_ADMIN_STATE_VOTING_OPEN, "votingOpen");

define(P_ADMIN_ENTRY_SENSITIVE, "sensitiveEntry");
define(P_ADMIN_ENTRY_NAME, "entryName");
define(P_ADMIN_ENTRY_DESCRIPTION, "entryDescription");
define(P_ADMIN_ENTRY_URL, "newEntryURL");

define(P_ADMIN_MOVE_DIRECTION, "moveDir");
define(P_ADMIN_ENTRY_ID, "entryID");

// Edit/New entry --------------------------------------------------------------
define(P_NEWEDIT_ENTRY_ID, "entryID");

// Vote index ------------------------------------------------------------------

/** \brief This action
 *
 */
define(P_VOTE_ACTION, "postVote");

/// \}

?>