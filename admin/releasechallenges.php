<?php
    include("../user/session.php");
    include("../config/config.php");

    if (!$_SESSION['admin']) {
        header("location:/user/logout");
        exit;
    }

    function redirectWithMessage($message) {
        header("location:/ctfpage?page=admin&message=$message");
        exit;
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
