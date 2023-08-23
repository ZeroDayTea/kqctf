<?php
    include("../user/session.php");
    include("../config/config.php");

if(($_SESSION['logintoken'] === $configjson['adminusername']) && isset($_POST['releasechallenges']))
    {
        $releasechallenges = $_POST['releasechallenges'];

        if($releasechallenges === 'yes')
        {
            $releasequery = "UPDATE challenges SET released=true;";
            if (!mysqli_query($conn, $releasequery))
            {
                header("location:/admin/adminpanel.php?message=errorrelease");
            }
            else
            {
                header("location:/admin/adminpanel.php?message=successrelease");
            }
        }
        else
        {
            header("location:/admin/adminpanel.php?message=norelease");
        }
    }
?>
