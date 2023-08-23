<?php
    include("../config/config.php");
    include("../user/session.php");

    if(($_SESSION['logintoken'] === $configjson['adminusername']) && isset($_POST['challengename']) && isset($_POST['challengedescription']) && isset($_POST['challengeauthor']) && isset($_POST['providedfile']) && isset($_POST['solutionflag']) && isset($_POST['category']) && isset($_POST['basescore']))
    {
        $challengename = $_POST['challengename'];
        $challengedescription = $_POST['challengedescription'];
        $challengeauthor = $_POST['challengeauthor'];
        $providedfile = $_POST['providedfile'];
        $solutionflag = $_POST['solutionflag'];
        $category = $_POST['category'];
        $basescore = $_POST['basescore'];

        $solutionflaghash = password_hash($solutionflag, PASSWORD_DEFAULT);

        $insertquery = "INSERT INTO challenges (challengename, challengedescription, challengeauthor, providedfile, solutionflag, category, basescore, released, solves) VALUES ('$challengename', '$challengedescription', '$challengeauthor', '$providedfile', '$solutionflaghash', '$category', $basescore, false, 0);";
        if (!mysqli_query($conn, $insertquery))
        {
            header("location:/admin/adminpanel.php?message=erroradd");
        }
        else
        {
            header("location:/admin/adminpanel.php?message=successadd");
        }
    }
?>
