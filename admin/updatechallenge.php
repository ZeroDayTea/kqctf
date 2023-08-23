<?php
    include("../config/config.php");
    include("../user/session.php");

    if(($_SESSION['logintoken'] === $configjson['adminusername']) && isset($_POST['oldchallengename']) && isset($_POST['challengename']) && isset($_POST['challengedescription']) && isset($_POST['challengeauthor']) && isset($_POST['providedfile']) && isset($_POST['solutionflag']) && isset($_POST['category']) && isset($_POST['basescore']))
    {
        $oldchallengename = mysql_real_escape_string($_POST['oldchallengename']);
        $challengename = mysql_real_escape_string($_POST['challengename']);
        $challengedescription = mysql_real_escape_string($_POST['challengedescription']);
        $challengeauthor = mysql_real_escape_string($_POST['challengeauthor']);
        $providedfile = mysql_real_escape_string($_POST['providedfile']);
        $solutionflag = $_POST['solutionflag'];
        $category = mysql_real_escape_string($_POST['category']);
        $basescore = mysql_real_escape_string($_POST['basescore']);

        $solutionflaghash = password_hash($solutionflag, PASSWORD_DEFAULT);

        $insertquery = "UPDATE challenges SET challengename='$challengename', challengedescription='$challengedescription', challengeauthor='$challengeauthor', providedfile='$providedfile', solutionflag='$solutionflaghash', category='$category', basescore='$basescore' WHERE challengename='$oldchallengename';";
        if (!mysqli_query($conn, $insertquery)) 
        {
            header("location:/admin/adminpanel.php?message=errorupdate");
        } 
        else 
        {
            header("location:/admin/adminpanel.php?message=successupdate");
        }
    }
?>
