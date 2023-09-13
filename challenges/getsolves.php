<?php
include("../config/config.php");
include("../user/session.php");

$challengename = isset($_POST['challengename']) ? $_POST['challengename'] : '';

$stmt = $conn->prepare("SELECT solvedchallenges.solvetime, teams.teamname FROM solvedchallenges JOIN teams ON solvedchallenges.solvedbyteam = teams.teamid WHERE challengename=? ORDER BY solvedchallenges.solvetime;");
$stmt->bind_param('s', $challengename);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        array_push($data, $row);
    }
    echo json_encode($data);
}
else {
    echo json_encode(array("error" => "No data found"));
}

$stmt->close();
?>
