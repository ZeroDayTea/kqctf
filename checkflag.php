<?php
    include("config.php");
    include("session.php");

    $infoJSON = isset($_POST['infoJSON'])?$_POST['infoJSON']:'';
    $infoArray = json_decode($_POST['infoJSON']);
    $challengename = rtrim($infoArray[0]);
    $flagguess = rtrim($infoArray[1]);

    $flagquery = "SELECT * FROM challenges WHERE challengename='$challengename';";
    $flagresult = mysqli_query($conn, $flagquery);
    $flagrow = mysqli_fetch_array($flagresult, MYSQLI_ASSOC);
    $count = mysqli_num_rows($flagresult);
    if($count == 1)
    {
        if(password_verify($flagguess, $flagrow['solutionflag']))
        {
            $username = $_SESSION['logintoken'];
            $teamquery = "SELECT team FROM users WHERE username='$username';";
            $teamresult = mysqli_query($conn, $teamquery);
            $teamrow = mysqli_fetch_array($teamresult, MYSQLI_ASSOC);
            $teamname = $teamrow['team'];

            $checksolvequery = "SELECT * FROM solvedchallenges WHERE solvedbyteam='$teamname' AND challengename='$challengename';";
            $checksolveresult = mysqli_query($conn, $checksolvequery);
            $teamsolves = mysqli_num_rows($checksolveresult);
            if(!($teamsolves > 0))
            {
                $solvesquery = "SELECT * FROM solvedchallenges WHERE challengename='$challengename';";
                $solvesresult = mysqli_query($conn, $solvesquery);
                $solves = mysqli_num_rows($solvesresult) + 1;
                $challengescore = $flagrow['basescore'];

                $pointsvalue = CTFCCCFormula($challengescore, $solves);

                $getpointsquery = "SELECT points FROM teams WHERE teamname='$teamname';";
                $getpointsresult = mysqli_query($conn, $getpointsquery);
                $getpointsrow = mysqli_fetch_array($getpointsresult, MYSQLI_ASSOC);
                $teampoints = (int)$getpointsrow['points'];
                $teampoints += $pointsvalue;

                $addpointsquery = "UPDATE teams SET points='$teampoints' WHERE teamname='$teamname';";
                if (!mysqli_query($conn, $addpointsquery)) 
                {
                    echo "Error Submitting Flag";
                }
                else
                {            
                    //add check if chall was already solved by team
                    $insertsolvequery = "INSERT INTO solvedchallenges VALUES ('$challengename', '$teamname', NOW());";
                    if(!mysqli_query($conn, $insertsolvequery))
                    {
                        echo "Error Submitting Flag";
                    }
                    else
                    {
                        updateTeamPoints($conn, $challengename);
                        $updatesolvesquery = "UPDATE challenges SET solves='$solves' WHERE challengename='$challengename';";
                        if(!mysqli_query($conn, $updatesolvesquery))
                        {
                            echo "Error Submitting Flag";
                        }
                        else
                        {
                            echo "Correct!";
                        }
                    }

                    
                }
            }
            else
            {
                echo "You already solved this challenge!";
            }

            
        }
        else
        {
            echo "nope!";
        }
    }
    else
    {
        echo "Error Submitting Flag";
    }
    

?>