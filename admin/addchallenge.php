<?php
    include("../config/config.php");
    include("../user/session.php");

    // endpoint only available to admins
    if (!$_SESSION['admin']) {
        header("location:/user/logout");
        exit;
    }

    function redirectWithMessage($message) {
        header("location:/ctfpage?page=admin&message=$message");
        exit;
    }

    $requiredFields = ['challengename', 'challengedescription', 'challengeauthor', 'providedfile', 'solutionflag', 'category', 'basescore'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            redirectWithMessage("incompleteData");
        }
    }

    $solutionflaghash = password_hash($_POST['solutionflag'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO challenges (challengename, challengedescription, challengeauthor, providedfile, solutionflag, category, basescore, released, solves) VALUES (?, ?, ?, ?, ?, ?, ?, false, 0);");

    $stmt->bind_param("ssssssi", $_POST['challengename'], $_POST['challengedescription'], $_POST['challengeauthor'], $_POST['providedfile'], $solutionflaghash, $_POST['category'], $_POST['basescore']);

    if ($stmt->execute()) {
        redirectWithMessage("successadd");
    } else {
        redirectWithMessage("erroradd");
    }
?>
