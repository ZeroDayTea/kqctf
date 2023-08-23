<?php
    include("../config/config.php");
    include("../user/session.php");

    $leaderboard = isset($_POST['selectedLeaderboard'])?$_POST['selectedLeaderboard']:'';

    if($leaderboard === 'All')
    {
        $leaderboardquery = "SELECT * FROM teams ORDER BY points DESC;";
        $leaderboardresult = mysqli_query($conn, $leaderboardquery);
        $counter = 1;
        $leaderboardHTML = "";
        while($leaderboardrow = mysqli_fetch_array($leaderboardresult, MYSQLI_ASSOC))
        {
        $teamname = htmlspecialchars($leaderboardrow['teamname'], ENT_QUOTES, 'UTF-8');
        $teampoints = $leaderboardrow["points"];
        $leaderboardHTML .= "<tr class=\"\" style=\"background-color:white\"><td>$counter</td><td><a class=\"ctflink\" id=\"teamname-$counter\">$teamname</a></td><td>$teampoints</td></tr>";
        $counter = $counter + 1;
        }

        echo $leaderboardHTML;
    }
    else
    {
        $leaderboardquery = "SELECT * FROM teams WHERE leaderboard='$leaderboard' ORDER BY points DESC;";
        $leaderboardresult = mysqli_query($conn, $leaderboardquery);
        $counter = 1;
        $leaderboardHTML = "";
        while($leaderboardrow = mysqli_fetch_array($leaderboardresult, MYSQLI_ASSOC))
        {
            $teamname = htmlspecialchars($leaderboardrow['teamname'], ENT_QUOTES, 'UTF-8');
            $teampoints = $leaderboardrow["points"];
            $leaderboardHTML .= "<tr class=\"\" style=\"background-color:white\"><td>$counter</td><td><a class=\"ctflink\" id=\"teamname-$counter\">$teamname</a></td><td>$teampoints</td></tr>";
            $counter = $counter + 1;
        }

        echo $leaderboardHTML;
    }

?>
