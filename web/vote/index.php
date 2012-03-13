<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

require_once('../config.php');
require_once('../components.php');
require_once('../functions.php');

$project = array(
                 array('id', 'name'),
                 array('id2', 'name2'),
                 array('id3', 'name3')
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
            <form name="postVote" action="" method="post"> <?php foreach($projects as $i => $project) {
            print('
                <table>
                    <tr id="projectName">
                        <td><h2>' . $project[$i] . '</h2></td>
                    </tr>
                    <div id="sliderBox">');
                        foreach($CRITERIA_DEFAULT as $criteria) { print('
                        <tr>
                            <td>' . $criteria[$CRITERIA_NAME] . '</td>
                            <td><input type="range" name="p' . $project[$i] . '.' . $criteria[$CRITERIA_NAME]
                            . '" value="0" min="-10" max="10" /></td>
                        </tr>');
                        } print('
                    </div>
                </table>');
            }
            ?>
                <table>
                    <tr id="projectName">
                        <td><h2>Project 2 Name<?php echo $NAME ?></h2></td>
                    </tr>
                    <div id="sliderBox"><?php
                        foreach($CRITERIA_DEFAULT as $criteria) {
                            print('
                        <tr>
                            <td>' . $criteria[$CRITERIA_NAME] . '</td>
                            <td><input type="range" name="p' . $project[1] . '.' . $criteria[$CRITERIA_NAME]
                            . '" value="0" min="-10" max="10" /></td>
                        </tr>');
                            }
                        ?>
                    
                    </div>
                </table>
                <table>
                    <tr id="projectName">
                        <td><h2>Project 3 Name<?php echo $NAME ?></h2></td>
                    </tr>
                    <div id="sliderBox"><?php
                        foreach($CRITERIA_DEFAULT as $criteria) {
                            print('
                        <tr>
                            <td>' . $criteria[$CRITERIA_NAME] . '</td>
                            <td><input type="range" name="p' . $project[2] . '.' . $criteria[$CRITERIA_NAME]
                            . '" value="0" min="-10" max="10" /></td>
                        </tr>');
                            }
                        ?>
                    
                    </div>
                </table>
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