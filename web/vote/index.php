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
?>
<html>
    <head>
        <title>Project Voting</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <script src="../html5slider.js"></script>
        <script type="text/javascript">
            function displaySliderValue(elementId, value) {
                var elem = document.getElementById(elementId);
                elem.innerHTML = value;
            }
        </script>
    </head>
    <body>
        <div id="header"><h1>Voting</h1></div>
        <div id="votingForm">
            <form name="postVote" action="" method="post"> <?php foreach($projects as $project) {
            echo '
                <div id="project">
                    <h2><div id="projectUrl"><a href="' . $project['url'] . '">' . $project['url'] . '</a></div><div id="projectName">' . $project['name'] . '</div></h2>
                    <table>
                        <div id="sliderBox">';
                            foreach($CRITERIA_DEFAULT as $j => $criteria) {
                                echo '
                            <tr>
                                <td>' . $criteria[$CRITERIA_NAME] . '</td>
                                <td>
                                    <input type="range" class="sliderBar" id="sliderBar' . $project['id'] . '.' . $j . '" name="p' . $project['id'] . '.' . $criteria[$CRITERIA_NAME]
                                    . '" value="0" min="-10" max="10" onchange="displaySliderValue(\'sliderValue' . $project['id'] . '.' . $j . '\', this.value)" />
                                    <span id="sliderValue' . $project['id'] . '.' . $j . '"><script>document.write(document.getElementById(\'sliderBar' . $project['id'] . '.' . $j . '\').value)</script></span>
                                </td>
                            </tr>';
                            }
                            echo '
                        </div>
                    </table>
                </div>';
            } ?>

                <table>
                    <tr>
                        <td><input type="submit" name="submit" /></td>
                    </tr>
                </table>
            </form>
        </div>
        <!--<div id="showVoted">
            <div id="projectName"><?php echo $projects[0]['name'] ?></div>
        </div>-->
    </body>
</html>