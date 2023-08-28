<?php
    include("../user/session.php");
    include("../config/config.php");

    function redirectWithMessage($message) {
        header("location:/admin/adminpanel.php?message=$message");
        exit();
    }

    if ($_SESSION['logintoken'] !== $configjson['adminusername']) {
        header("location:/user/logout");
        exit();
    }

    if (!isset($_POST['releasechallenges'])) {
        redirectWithMessage("incompleteData");
    }

    $releasechallenges = $_POST['releasechallenges'];
    if($releasechallenges === 'yes') {
        $stmt = $conn->prepare("UPDATE challenges SET released=true;");
        if ($stmt->execute()) {
            redirectWithMessage("successrelease");
        } else {
            redirectWithMessage("errorrelease");
        }
    } else {
        redirectWithMessage("norelease");
    }
?>
