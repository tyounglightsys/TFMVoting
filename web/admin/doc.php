<?php

/** \file doc.php
 * \brief This file is the documentation for the administrator.
 *
 */

// Includes and Requires -------------------------------------------------------
require_once('../config.php');
require_once(LAYOUT_PATH_ROOT . 'header_start.php');

// Processing ------------------------------------------------------------------

// Generation ------------------------------------------------------------------
$title = "TFM Documentation";


// Header ----------------------------------------------------------------------
require_once(LAYOUT_PATH_ROOT . 'header_end.php'); 
?>
<h2>Documentation:</h2>

<dl>
<dt><a href="#Steps">Steps to follow</a><br>
<dt><a href="#Security">How TFM Security is handled with this program.</a><br>
</dl>
<br>
<center><hr width=20%></center>
<br>

<h2>
    <a name=Steps>The steps for managing a TFM contest are as follows:</a>
</h2>
    <ul>
	<li>Create a new project set with the following settings:
	<ul>
	    <li>Open For Voting: <b>unckecked</b>
	    <li>Showing Results: <b>unchecked</b>
	    <li>Archived: <b>unchecked</b>
	</ul>
	<li>Add the various TFM entries.
	<ul>
	    <li>On the admin page for the project, "add new entry" until done
	    <li>Use the order buttons "^" and "v" to move the entries up and down until they are in the display order you want during voting.
	    <li>Keep doing so until you are ready for TFM Voting.
	    <li>Because we vote for all projects at once, you may not want to open voting until all projects have had a chance to present.
	    <li>If a sensitive project is added, make sure you use an .htaccess file in the TFM root to password protect the voting procedure.
	</ul>
	<li>Enable Voting:
	<ul>
	    <li>On the Admin page, check the "open for voting" checkmark and "Update State"
	    <li>You may also wish to check the "archived" button so the current year's TFM will now show up on the list of TFMs.  Otherwise, you need to give a URL that contains the project set string so participants can find where to vote.
	    <li>We use a cookie on people's computer to determine if they have already voted or not.
	</ul>
	<li>Finish voting
	<ul>
	    <li>On the admin page, uncheck "Open For Voting"
	    <li>On the admin page, leave "showing results" unckecked (recommended at this time)
	    <li>Check "Archived" so that it is easy to find the project set.
	</ul>
	<li>Present the results during ICCM
	<ul>
	    <li>The admin can see the results of the voting on the admin page.
	    <li>(recommended) We keep the results hidden so that the results are not known by everyone.
	</ul>
	<li>Once the contest is over, we can make the results public
	<ul>
	    <li>on the admin page, check "showing results" and then update the state.
	    <li>The final state of the check-boxes for an archived project should be:
	    <ul>
		<li>Open For Voting: <b>unckecked</b>
		<li>Showing Results: <b>checked</b>
		<li>Archived: <b>checked</b>
	    </ul>
	</ul>
	<li>We leave the past years around for posterity's sake, at least for a few years.
    </ul>

<h2>
    <a name=Security>How security is handled</a>
</h2>
When editing a TFM submission, there is a check-box stating something is a sensitive project.  Sensitive projects are handled as follows:<br>
When a sensitive project is viewed by the admin, all the information is visible (name, URL, description)<br>
When a sensitve project is voted upon, all the information is visible (name, URL, description)<br>
When a sensitive project is viewed in the archive, only the words, "sensitive project" are visible.<br>
<br>
So, you want to make sure you close voting for all years when there was a sensitive project.<br>
<br>
No encryption is done on the database, whether for sensitive projects or normal projects.  If something is truly life-threatening, you should choose to edit the entry after the contest has closed to remove that information.
<br>
We have a simple .htaccess file in the admin directory, but we do not have one for normal TFM voting.  You can use the .htaccess file in the admin directory as a template for the one at the root TFM directory if needed.

<?php require_once(LAYOUT_PATH_ROOT . 'footer.php') ?>
