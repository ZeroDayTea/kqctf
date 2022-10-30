<?php
    define('DB_SERVERNAME', 'localhost');
    define('DB_USERNAME', 'kquser');
    define('DB_PASSWORD', ''); // load db password from file or environment variable that is not in the repo when implementing this framework
    define('DB_DATABASENAME', 'kqctf');
    $conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    function CTFCCCFormula($pts,$cnt) {
        $base = $pts * 0.2;
        $res = $base + (($pts - $base) / pow(1 + max(0,$cnt) / 100.92201,1.206069));
        return max(1,round($res));
      }

    function updateTeamPoints($connection, $challengename) {
        $getteamsquery = "SELECT DISTINCT solvedbyteam FROM solvedchallenges WHERE challengename='$challengename';";
        $getteamsresult = mysqli_query($connection, $getteamsquery);
        while($getteamsrow = mysqli_fetch_array($getteamsresult, MYSQLI_ASSOC))
        {
            $team = $getteamsrow['solvedbyteam'];
            $getsolvedchalls = "SELECT DISTINCT challengename FROM solvedchallenges WHERE solvedbyteam='$team';";
            $getsolvedchallsresult = mysqli_query($connection, $getsolvedchalls);
            
            if(mysqli_num_rows($getsolvedchallsresult) > 0)
            {
                $totalpoints = 0;
                while($getsolvedchall = mysqli_fetch_array($getsolvedchallsresult, MYSQLI_ASSOC))
                {
                    $challname = $getsolvedchall['challengename'];
                    $solvecountquery = "SELECT * FROM solvedchallenges WHERE challengename='$challname';";
                    $solvecountresult = mysqli_query($connection, $solvecountquery);

                    $solves = mysqli_num_rows($solvecountresult);
                    
                    $getbasepointsquery = "SELECT basescore FROM challenges WHERE challengename='$challengename';";
                    $getbasepointsresult = mysqli_query($connection, $getbasepointsquery);
                    $getbasepointsrow = mysqli_fetch_array($getbasepointsresult);
                    $challpoints = CTFCCCFormula((int)$getbasepointsrow['basescore'], $solves);
                    $totalpoints += $challpoints;
                }
                $addpointsquery = "UPDATE teams SET points=$totalpoints WHERE teamname='$team';";
                mysqli_query($connection, $addpointsquery);
            }
            
        }
    }

?>
