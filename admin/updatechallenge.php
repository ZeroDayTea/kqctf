<?php
    include("../config/config.php");
    include("../user/session.php");

    function redirectToAdminPanel($message) {
        header("location:/admin/adminpanel?message=$message");
        exit();
    }

    if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
        header("location:/user/logout");
        exit()
    }

    $requiredParams = ['oldchallengename', 'challengename', 'challengedescription', 'challengeauthor', 'providedfile', 'solutionflag', 'category', 'basescore'];
    foreach ($requiredParams as $param) {
        if (!isset($_POST[$param])) {
            redirectToAdminPanel("incompleteData");
        }
    }

    $oldchallengename = $_POST['oldchallengename'];
    $challengename = $_POST['challengename'];
    $challengedescription = $_POST['challengedescription'];
    $challengeauthor = $_POST['challengeauthor'];
    $providedfile = $_POST['providedfile'];
    $solutionflaghash = password_hash($_POST['solutionflag'], PASSWORD_DEFAULT);
    $category = $_POST['category'];
    $basescore = $_POST['basescore'];

    $stmt = $conn->prepare("UPDATE challenges SET challengename=?, challengedescription=?, challengeauthor=?, providedfile=?, solutionflag=?, category=?, basescore=? WHERE challengename=?");
    $stmt->bind_param("ssssssis", $challengename, $challengedescription, $challengeauthor, $providedfile, $solutionflaghash, $category, $basescore, $oldchallengename);

    if ($stmt->execute()) {
        redirectToAdminPanel("successupdate");
    } else {
        redirectToAdminPanel("errorupdate");
    }
?>
