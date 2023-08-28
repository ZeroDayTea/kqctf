<?php
include("../user/session.php");
include("../config/config.php");

// Function to get challenge counts by category
function getChallengeCounts($conn, $condition = "", $team = null) {
    $categories = ['crypto', 'misc', 'pwn', 'rev', 'web'];
    $counts = [];

    foreach ($categories as $category) {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM challenges WHERE released=true AND category=? $condition");

        if ($team) {
            $stmt->bind_param('si', $category, $team);  // 's' for string (category), 'i' for integer (team)
        } else {
            $stmt->bind_param('s', $category);
        }

        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $counts[$category] = $result['count'];
        $stmt->close();
    }

    return $counts;
}

// Get total challenges by category
$totalChallenges = getChallengeCounts($conn);

// Get user's team
$stmt = $conn->prepare("SELECT team FROM users WHERE username=?");
$stmt->bind_param("s", $_SESSION['logintoken']);
$stmt->execute();
$team = $stmt->get_result()->fetch_assoc()['team'];
$stmt->close();

// Get solved challenges by category for the team
$solvedChallenges = getChallengeCounts($conn, "AND EXISTS (SELECT 1 FROM solvedchallenges WHERE challenges.challengename = solvedchallenges.challengename AND solvedbyteam=?)", $team);

// 'Include Solved' refers to the total
$solvedChallenges['Include Solved'] = array_sum($solvedChallenges);
$totalChallenges['Include Solved'] = array_sum($totalChallenges);

// Format the output
$solves = [];
foreach ($totalChallenges as $category => $count) {
    $solves[] = "$category (" . $solvedChallenges[$category] . "/$count solved)";
}

echo json_encode($solves);
?>
