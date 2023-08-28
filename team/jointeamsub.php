<?php
include("../config/config.php");
include("../user/session.php");

if (isset($_POST['teamname'], $_POST['teampassword'])) {
    $teamname = $_POST['teamname'];
    $teampassword = $_POST['teampassword'];

    // check if team exists and get its password
    $stmt = $conn->prepare("SELECT teamid, password FROM teams WHERE teamname = ?");
    $stmt->bind_param("s", $teamname);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($team, $hashedPassword);
        $stmt->fetch();

        if (password_verify($teampassword, $hashedPassword)) {
            // check team capacity
            $stmt->close();
            $stmt = $conn->prepare("SELECT COUNT(*) as memberCount FROM users WHERE team = ?");
            $stmt->bind_param("s", $team);
            $stmt->execute();
            $stmt->bind_result($memberCount);
            $stmt->fetch();

            if ($memberCount >= $configjson['maxteamsize']) {
                redirectToError('teamfull');
            }

            $stmt->close();

            $username = $_SESSION['logintoken'];
            // Update user's team
            $stmt = $conn->prepare("UPDATE users SET team = ? WHERE username = ?");
            $stmt->bind_param("ss", $team, $username);
            $stmt->execute();
            $stmt->close();

            header("location:/ctfpage.php?page=team");
            exit;
        } else {
            redirectToError('incorrectjoin');
        }
    } else {
        redirectToError('incorrectjoin');
    }
} else {
    redirectToError('missingdetails');
}

function redirectToError($error) {
    header("location:/ctfpage.php?page=team&error={$error}");
    exit;
}
?>
