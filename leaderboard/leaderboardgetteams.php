<?php
    include("../config/config.php");
    include("../user/session.php");

    $leaderboard = isset($_POST['selectedLeaderboard'])?$_POST['selectedLeaderboard']:'All';

    if($leaderboard === 'All')
    {
        $leaderboardquery = $conn->prepare("SELECT * FROM teams ORDER BY points DESC;");
        $leaderboardquery->execute();
        $leaderboardresult = $leaderboardquery->get_result();

        $counter = 1;
        $leaderboardHTML = "";

        while($leaderboardrow = $leaderboardresult->fetch_assoc())
        {
        $teamname = htmlspecialchars($leaderboardrow['teamname'], ENT_QUOTES, 'UTF-8');
        $teampoints = htmlspecialchars($leaderboardrow["points"], ENT_QUOTES, 'UTF-8');
        $leaderboardHTML .= <<<HTML
          <tr class="" style="background-color:white">
          <td>{$counter}</td>
          <td><a class="ctflink" id="teamname-{$counter}">{$teamname}</a></td>
          <td>{$teampoints}</td>
          </tr>
        HTML;

        $counter++;
        }

        $leaderboardquery->close();

        echo $leaderboardHTML;
    }
    else
    {
        $leaderboardquery = $conn->prepare("SELECT * FROM teams WHERE leaderboard=? ORDER BY points DESC;");
        $leaderboardquery->bind_param("s", $leaderboard);
        $leaderboardquery->execute();
        $leaderboardresult = $leaderboardquery->get_result();

        $counter = 1;
        $leaderboardHTML = "";

        while($leaderboardrow = $leaderboardresult->fetch_assoc())
        {
            $teamname = htmlspecialchars($leaderboardrow['teamname'], ENT_QUOTES, 'UTF-8');
            $teampoints = htmlspecialchars($leaderboardrow["points"], ENT_QUOTES, 'UTF-8');
            $leaderboardHTML .= <<<HTML
                <tr class="" style="background-color:white">
                <td>{$counter}</td>
                <td><a class="ctflink" id="teamname-{$counter}">{$teamname}</a></td>
                <td>{$teampoints}</td>
                </tr>
                HTML;

            $counter++;
        }

        $leaderboardquery->close();

        echo $leaderboardHTML;
    }

?>
