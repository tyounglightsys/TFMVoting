<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

require_once('../config.php');
require_once('../components.php');
require_once('../functions.php');

$projects = array(
                 array('id' => 0,
                       'name' => 'Something',
                       'url' => 'http://lolcats'),
                 array('id' => 1,
                       'name' => 'Something else',
                       'url' => 'www'),
                 array('id' => 2,
                       'name' => 'Something fun',
                       'url' => 'wat')
                );

$PROJECT_ID = 0;
$PROJECT_NAME = 1;
?>
<html>
    <head>
        <title>Project Voting</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div id="header"><h1>Voting</h1></div>
        <div id="votingForm">
            <form name="postVote" action="" method="post"> <?php foreach($projects as $project) {
            print('
                <div class="project">
                    <h2><span id="projectName">' . $project['name'] . '</span><span id="projectUrl"><a href="' . $project['url'] . '">' . $project['url'] . '</a></span></h2>
                    <table>
                        <div id="sliderBox">');
                            foreach($CRITERIA_DEFAULT as $criteria) { print('
                            <tr>
                                <td>' . $criteria[$CRITERIA_NAME] . '</td>
                                <td><input type="range" name="p' . $project['id'] . '.' . $criteria[$CRITERIA_NAME]
                                . '" value="0" min="-10" max="10" /></td>
                            </tr>');
                            } print('
                        </div>
                    </table>
                </div>');
            }
            ?>
                <table>
                    <tr>
                        <td><input type="submit" name="submit" /></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="showVoted">
            <div id="projectName"><?php echo $NAME ?></div>
        </div>
    </body>
</html>