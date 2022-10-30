<?php
    include("config.php");
    include("session.php");

    if(isset($_POST['teamname']) && isset($_POST['teampassword']))
    {
        $teamname = $_POST['teamname'];
        $teampassword = $_POST['teampassword'];

        $query = "SELECT * FROM teams WHERE teamname='$teamname';";
        $result = mysqli_query($conn, $query);
	    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 1)
        {
            if(password_verify($teampassword, $row["password"]))
            {
                $membercount = 1;
                if($membercount >= 7)
                {
                    header("location:ctfpage.php?page=team&error=teamfull");
                }
                $teamname = $row['teamname'];
                $username = $_SESSION['logintoken'];
                $updatequery = "UPDATE users SET team='$teamname' WHERE username='$username';";
                $update_query_run = mysqli_query($conn, $updatequery);
                header("location:ctfpage.php?page=team");
            }
            else
            {
                header("location:ctfpage.php?page=team&error=incorrectjoin");
            }
        }
        else
        {
            header("location:ctfpage.php?page=team&error=incorrectjoin");
        }
    }
?>