<?php
include("../config/config.php");
include("../user/session.php");

if (isset($_POST['teamname'], $_POST['teampassword'], $_POST['teamretypepassword'])) {

    $teamname = $_POST['teamname'];
    $teampassword = $_POST['teampassword'];
    $teamretypepassword = $_POST['teamretypepassword'];
    $leaderboard = "Open/College Division";
    $username = $_SESSION['logintoken'];

    if ($teampassword !== $teamretypepassword) {
        redirectToError('passwordsdonotmatch');
    }

    // Check if team exists
    $stmt = $conn->prepare("SELECT teamname FROM teams WHERE teamname = ?");
    $stmt->bind_param("s", $teamname);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        redirectToError('teamnametaken');
    }
    $stmt->close();

    $teampasswordhash = password_hash($teampassword, PASSWORD_DEFAULT);

    // Insert the new team
    $stmt = $conn->prepare("INSERT INTO teams (teamname, password, points, leaderboard, mostrecentsoltime) VALUES (?, ?, 0, ?, NOW())");
    $stmt->bind_param("sss", $teamname, $teampasswordhash, $leaderboard);
    $successTeamInsert = $stmt->execute();
    $teamId = $conn->insert_id;
    $stmt->close();

    // Update the user's team
    $stmt = $conn->prepare("UPDATE users SET team=? WHERE username=?");
    $stmt->bind_param("is", $teamId, $username);
    $successUserUpdate = $stmt->execute();
    $stmt->close();

    if ($successTeamInsert && $successUserUpdate) {
        header("location:/ctfpage.php?page=team");
        exit;
    } else {
        redirectToError('adminerror');
    }
} else {
    redirectToError('adminerror');
}

function redirectToError($error) {
    header("location:/ctfpage.php?page=team&error={$error}");
    exit;
}
?>
