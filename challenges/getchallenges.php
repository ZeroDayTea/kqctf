<?php
include("../config/config.php");
include("../user/session.php");

// get all the challenges to display based on the categories that were checked and whether to show solved challenges
function getChallenges($conn, $categories, $teamname, $includeSolved) {
    $baseQuery = "
        SELECT c.category, c.challengename, c.challengeauthor, c.challengedescription, c.basescore, c.providedfile
        FROM challenges c
        LEFT JOIN solvedchallenges s ON s.challengename = c.challengename AND s.solvedbyteam = ?
        WHERE c.released = true
    ";

    if (!$includeSolved) {
        $baseQuery .= "AND s.solvedbyteam IS NULL ";
    }

    if (empty($categories)) {
        $query = $baseQuery . "ORDER BY c.solves DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $teamname);
    } else {
        $in = implode(',', array_fill(0, count($categories), '?'));
        $query = $baseQuery . "AND c.category IN ($in) ORDER BY c.solves DESC";
        $stmt = $conn->prepare($query);

        $types = str_repeat('s', count($categories) + 1); // The number of s characters should equal the number of parameters
        $stmt->bind_param($types, ...array_merge([$teamname], $categories));
    }

    $stmt->execute();

    return $stmt->get_result();
}

function getSolveCount($conn, $challengeName) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM solvedchallenges WHERE challengename = ?");
    $stmt->bind_param("s", $challengeName);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['COUNT(*)'];
}

// determine which categories were checked except first element which is 'Include Solved'
$checkedJSON = $_POST['checkedJSON'] ?? '';
$checkedArray = json_decode($checkedJSON, true);
$categoryNameArray = ["crypto", "misc", "pwn", "rev", "web"];
$selectedCategories = array();
for($i = 1; $i < count($checkedArray); $i++) {
    if($checkedArray[$i]) {
        array_push($selectedCategories, $categoryNameArray[$i-1]);
    }
}

// whether or not 'Include Solved' was checked
$includeSolved = $checkedArray[0];

$username = $_SESSION['logintoken'];
$teamStmt = $conn->prepare("SELECT team FROM users WHERE username=?;");
$teamStmt->bind_param("s", $username);
$teamStmt->execute();
$teamResult = $teamStmt->get_result()->fetch_assoc();
$teamid = $teamResult['team'];

$challengesHTML = '';
$challengesResult = getChallenges($conn, $selectedCategories, $teamid, $includeSolved);

while($challengerow = $challengesResult->fetch_assoc()) {
    $solves = getSolveCount($conn, $challengerow['challengename']);
    $pointsvalue = CTFCCCFormula($challengerow['basescore'], $solves);
    $challengename = htmlspecialchars($challengerow['challengename'], ENT_QUOTES, 'UTF-8');
    $challengeauthor = htmlspecialchars($challengerow['challengeauthor'], ENT_QUOTES, 'UTF-8');
    $challengedescription = htmlspecialchars($challengerow['challengedescription'], ENT_QUOTES, 'UTF-8');
    $challengefile = htmlspecialchars($challengerow['providedfile'], ENT_QUOTES, 'UTF-8');
    $flagformat = $configjson['flagformat'];

    $challengesHTML .= <<<HTML
    <div class='challengeBox' id='challengeBox'>
        <div class='row'>
            <div class='col-6'>
                    <div class='chal-title' name='{$challengename}'> {$challengename} <br></div>
                    <div class='chal-author'> {$challengeauthor} </div>
                </div>
                <div class='col-6 chal-leftcard'>
                    <a data-bs-toggle="modal" data-bs-target="#challengesolves-modal" href="#" class='chal-solves'> {$solves} solves /  {$pointsvalue} points</a>
                </div>
            </div>
            <div class='chal-divider'></div>
            <div class='chal-des'>
                $challengedescription
                <div class='input-group mb-3 chal-submit'>
                <input autocomplete='off' autocorrect='off' type='text' class='form-control' placeholder='$flagformat' aria-label='Flag' aria-describedby='flag-btn-' style='background: #FAFAFA' name='flaginput'>
                <div class='input-group-append''>
                    <button class='btn btn-outline-secondary' type='button' name='checkflagbtn' onClick='checkFlag(event);'>Submit</button>
                </div>
                </div>
            </div>
HTML;

     if($challengefile != "" and !empty($challengefile)) {
          $challengesHTML .= <<<HTML
          <div class='chal-downloads'>
          <p style="margin-bottom: 3px;">Downloads</p>
          <div class="tag-container"><a href="./Public/{$challengefile}" class="ctflink" download="">{$challengefile}</a></div>
          </div>
          HTML;
     }

     $challengesHTML .= <<<HTML
            </div>
        </div>
        HTML;
}

echo $challengesHTML;
?>
