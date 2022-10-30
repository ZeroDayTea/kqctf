<?php
    include("config.php");
    include("session.php");

    if(isset($_POST['teampassword']))
    {
        $inputpass = $_POST['teampassword'];
        $username = $_SESSION['logintoken'];
        $query = "SELECT * FROM users WHERE username='$username';";
        $result = mysqli_query($conn, $query);
        $userrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $team = $userrow['team'];

        $loopthroughteams = "SELECT * FROM teams;";
        $loopthroughteamsresult = mysqli_query($conn, $loopthroughteams);
        $verified = false;
        while($currentloopteam = mysqli_fetch_array($loopthroughteamsresult, MYSQLI_ASSOC))
        {
            if(password_verify($inputpass, $currentloopteam['password']))
            {
                $id = $currentloopteam['id'];
                $updatequery = "UPDATE teams SET teamname='$team' WHERE id='$id';";
                mysqli_query($conn, $updatequery);
                $verified = true;
                header("Location:ctfpage.php?page=home");
                $update2 = "UPDATE users SET verified=true WHERE username='$username';";
                mysqli_query($conn, $update2);
            }
        }
        if($verified == false)
        {

            echo "Incorrect password. Go back and re-verify your team.";
        }

        
    }
    
?>