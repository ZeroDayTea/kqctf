<?php
    include("config.php");
    include("session.php");

    if(isset($_POST['teamname']) && isset($_POST['teampassword']) && isset($_POST['teamretypepassword']))
    {
        $teamname = $_POST['teamname'];
        $teampassword = $_POST['teampassword'];
        $teamretypepassword = $_POST['teamretypepassword'];
        $leaderboard = $_POST['teamleaderboard'];
        
        $username = $_SESSION['logintoken'];
        if($teampassword !== $teamretypepassword)
        {
            header("location:ctfpage.php?page=team&error=passwordsdonotmatch");
        }

        $teampasswordhash = password_hash($teampassword, PASSWORD_DEFAULT);
        
        $checkquery2 = "SELECT * FROM teams WHERE teamname='$teamname';";
        $result2 = mysqli_query($conn, $checkquery2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $count2 = mysqli_num_rows($result2);

        if ($count2 == 0) 
        {
            $query = "INSERT INTO teams (teamname, password, points, leaderboard, mostrecentsoltime) VALUES ('$teamname', '$teampasswordhash', '0', '$leaderboard', '');";
            $query_run = mysqli_query($conn, $query);

            $userquery = "UPDATE users SET team='$teamname' WHERE username='$username';";
            $userquery_run = mysqli_query($conn, $userquery);

            if($query_run)
            {   
                if($userquery_run)
                {
                    header("location:ctfpage.php?page=team");
                }
                else
                {
                    header("location:ctfpage.php?page=team&error=adminerror");
                }
                
            }
            else
            {
                header("location:ctfpage.php?page=team&error=adminerror");
            }
        }
        else
        {
            header("location:ctfpage.php?page=team&error=teamnametaken");
        } 
    }
    else
    {
        header("location:ctfpage.php?page=team&error=adminerror");
    }
?>