<?php
    include("session.php");
    include("config.php");

    if(isset($_POST['releasechallenges']))
    {
        $releasechallenges = $_POST['releasechallenges'];

        if($releasechallenges === 'yes')
        {
            $releasequery = "UPDATE challenges SET released=true;";
            if (!mysqli_query($conn, $releasequery)) 
            {
                header("location:adminpanel.php?message=errorrelease");
            } 
            else 
            {
                header("location:adminpanel.php?message=successrelease");
            }
        }
        else
        {
            header("location:adminpanel.php?message=norelease");
        }
    }
?>