<?php
include("../config/config.php");
include("../user/session.php");

// first element is challenge name and second element is flag guess
$infoJSON = isset($_POST['infoJSON']) ? $_POST['infoJSON'] : '';

if($infoJSON === '') {
    echo "Invalid request!";
    exit;
}

$infoArray = json_decode($_POST['infoJSON'], true);
if(count($infoArray) != 2) {
    echo "Invalid data format!";
    exit;
}

$challengename = rtrim($infoArray[0]);
$flagguess = rtrim($infoArray[1]);

$stmt = $conn->prepare("SELECT * FROM challenges WHERE challengename=?");
$stmt->bind_param('s', $challengename);
$stmt->execute();
$flagresult = $stmt->get_result();
$flagrow = $flagresult->fetch_assoc();
$stmt->close();

if ($flagresult) {
    if (password_verify($flagguess, $flagrow['solutionflag'])) {
        $username = $_SESSION['logintoken'];
        $team = getTeamByUserName($conn, $username);
        if(!hasTeamSolvedChallenge($conn, $team, $challengename)) {
            $pointsvalue = calculatePointsValue($conn, $flagrow, $challengename);
            if(updateTeamPointsAndChallengeSolves($conn, $team, $challengename, $pointsvalue)) {
                echo "Correct!";
            } else {
                echo "Error Submitting Flag";
            }
        } else {
            echo "You already solved this challenge!";
        }
    } else {
        echo "Incorrect guess!";
    }
} else {
    echo "Error Submitting Flag";
}

function hasTeamSolvedChallenge($conn, $team, $challengename) {
    $stmt = $conn->prepare("SELECT * FROM solvedchallenges WHERE solvedbyteam=? AND challengename=?");
    $stmt->bind_param('is', $team, $challengename);
    $stmt->execute();
    $solved = ($stmt->get_result()->num_rows) > 0;
    $stmt->close();
    return $solved;
}

function calculatePointsValue($conn, $flagrow, $challengename) {
    $stmt = $conn->prepare("SELECT * FROM solvedchallenges WHERE challengename=?");
    $stmt->bind_param('s', $challengename);
    $stmt->execute();
    $solves = $stmt->get_result()->num_rows + 1;
    $stmt->close();
    return CTFCCCFormula($flagrow['basescore'], $solves);
}

function updateTeamPointsAndChallengeSolves($conn, $team, $challengename, $pointsvalue) {
    $stmt = $conn->prepare("UPDATE teams SET points = points + ?, mostrecentsoltime=NOW() WHERE teamid=?");
    $stmt->bind_param('ii', $pointsvalue, $team);
    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO solvedchallenges (challengename, solvedbyteam, solvetime) VALUES (?, ?, NOW())");
    $stmt->bind_param('si', $challengename, $team);
    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $stmt->close();

    $stmt = $conn->prepare("UPDATE challenges SET solves = solves + 1 WHERE challengename=?");
    $stmt->bind_param('s', $challengename);
    if (!$stmt->execute()) {
        $stmt->close();
        return false;
    }
    $stmt->close();
    return true;
}
?>
