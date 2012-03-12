<?php
/** \file vote/index.php
 *  \brief This file manages the user's view in three states
 *         - not started, open, and published.
 */

require_once('../config.php');
require_once('../components.php');
require_once('../functions.php');

?>

<html>
    <head>
        <title>Project Voting</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <div id="header"><h1>Voting</h1></div>
        <div id="votingForm">
            <form name="postVote" action="" method="post">
                <table>
                    <tr id="projectName">
                        <td><h2>Project Name 1<?php echo $NAME ?></h2></td>
                    </tr>
                    <div id="sliderBox">
                        <tr>
                            <td style="width: 50px;" alt="testing!">Impact</td>
                            <td><input type="range" name="Impact" value="0" min="-10" max="10" /></td>
                        </tr>
                        <!-- <?php
                            /*
                            foreach($DEFAULT_CRITERIA as $criteria) {
                                print('<span on>');
                                print('' . $criteria[0]);
                                
                                print('</span>');
                            }
                            */
                        ?> -->
                        <tr>
                            <td>Quality</td>
                            <td><input type="range" name="Quality" value="0" min="-10" max="10" /></td>
                        </tr>
                        <tr>
                            <td>Co-operation</td>
                            <td><input type="range" name="Cooperation" value="0" min="-10" max="10" /></td>
                        </tr>
                        <tr>
                            <td>Re-usability</td>
                            <td><input type="range" name="Reusability" value="0" min="-10" max="10" /></td>
                        </tr>
                    </div>
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