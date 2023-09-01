<?php
$errors = [];
$teamInfo = [];
$solvedChallenges = [];
$members = [];

if(isset($_GET['team'])) {
    $teamname = $_GET['team'];
    $stmt = $conn->prepare("SELECT teamid FROM teams WHERE teamname=?");
    $stmt->bind_param("s", $teamname);
    $stmt->execute();
    $stmt->bind_result($team);
    $stmt->fetch();
    $stmt->close();
}
    if($team !== NULL) {
        // Fetch team info
        $stmt = $conn->prepare("SELECT teamname, leaderboard FROM teams WHERE teamid=?");
        $stmt->bind_param("i", $team);
        $stmt->execute();
        $teamInfo = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        // Fetch team members
        $stmt = $conn->prepare("SELECT username FROM users WHERE team=?");
        $stmt->bind_param("i", $team);
        $stmt->execute();
        $membersResult = $stmt->get_result();
        while($row = $membersResult->fetch_assoc()) {
            $members[] = $row;
        }
        $stmt->close();

        // Fetch solved challenges
        $stmt = $conn->prepare("SELECT challengename, solvetime FROM solvedchallenges WHERE solvedbyteam=?");
        $stmt->bind_param("i", $team);
        $stmt->execute();
        $solvedChallengesResult = $stmt->get_result();
        while($row = $solvedChallengesResult->fetch_assoc()) {
            $solvedChallenges[] = $row;
        }
        $stmt->close();
    }

// Centralized error handling
$errorMessages = [
    'usernametaken' => 'Username is already taken',
    'teamnametaken' => 'A team with that team name already exists',
    'passwordsdonotmatch' => 'Passwords do not match',
    'adminerror' => 'Something went wrong. Please contact an admin',
    'incorrectjoin' => 'Username/Password combination is incorrect',
    'adminerrorjoin' => 'Something went wrong. Please contact an admin',
    'teamfull' => 'That team is full'
];

if(isset($_GET['error']) && isset($errorMessages[$_GET['error']])) {
    $errors[] = $errorMessages[$_GET['error']];
}

// Begin output
?>
<?php if(empty($teamInfo)): ?>
<section id="login" class="login">
    <div class="container" data-aos="fade-up">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <!-- Register New Team Form -->
            <div class="col-lg-6 center">
                <form class="input-forms" action="/team/registerteamsub.php" method="post">
                    <div class="section-title">
                        <h3><span>Register New Team:</span></h3>
                    </div>

                    <div class="row">
                        <label class="form-label text-center">Team Credentials</label>
                        <div class="col form-group">
                            <input type="text" class="form-control" name="teamname" placeholder="Team Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <input type="password" class="form-control" name="teampassword" placeholder="Team  Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <input type="password" class="form-control" name="teamretypepassword" placeholder="Retype Password" required>
                        </div>
                    </div>
                    <!--
                    <div class="row">
                        <label class="form-label text-center">Team Eligibility</label>
                        <div class="col form-group">
                            <select class="form-control" name="teamleaderboard" id="teamleaderboard">
                                <option value="Open/College Division">Open/College Division</option>
                                <option value="High School Division">High School Division</option>
                                <option value="Middleschool Division">Middle School Division</option>
                            </select>
                        </div>
                    </div>
                    -->

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>

            <!-- Join Existing Team Form -->
            <div class="col-lg-6 center">
                <form class="input-forms" action="/team/jointeamsub.php" method="post">
                    <div class="section-title">
                        <h3><span>Join Existing Team:</span></h3>
                    </div>

                    <div class="row">
                        <div class="col form-group">
                             <input type="text" class="form-control" name="teamname" placeholder="Team Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="teampassword" placeholder="Team Password" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Join</button>
                    </div>
                </form>
            </div>

            <?php foreach($errors as $error): ?>
                <h5 style="color:red; text-align:center"><?= htmlspecialchars($error) ?></h5>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php else: ?>
<div class="section-title">
    <h2>Team Information</h2>
    <h3>Team: <?= htmlspecialchars($teamInfo['teamname']) ?></h3>
    <h5>Leaderboard: <?= htmlspecialchars($teamInfo['leaderboard']) ?></h5>
</div>
<div class="col-6 center" style="min-height: 230px;">
    <table class="table scoreboard" style="border: none; background-color: white;">
        <thead style="text-align: center;">
            <tr>
                <th style="width: 4em;border-top: none;">#</th>
                <th style="border-top: none;">Member</th>
            </tr>
        </thead>
        <tbody style="text-align: center;" id="sc-teams">
            <?php $counter = 1; ?>
            <?php foreach($members as $member): ?>
                <tr>
                    <th style="font-weight:normal;"><?= $counter ?></th>
                    <td style="font-weight:normal;"><?= htmlspecialchars($member['username']) ?></td>
                </tr>
                <?php $counter++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <br>

    <table class="table scoreboard" style="border: none; background-color: white;">
        <thead style="text-align: center;">
            <tr>
                <th style="width: 4em;border-top: none;">#</th>
                <th style="border-top: none;">Solved</th>
                <th style="width: 12em;border-top: none;">Time</th>
            </tr>
        </thead>
        <tbody style="text-align: center;" id="sc-challenges">
            <?php $challCounter = 1; ?>
            <?php foreach($solvedChallenges as $challenge): ?>
                <tr>
                    <th style="font-weight:normal;"><?= $challCounter ?></th>
                    <td style="font-weight:normal;"><?= htmlspecialchars($challenge['challengename']) ?></td>
                    <td style="font-weight:normal;"><?= htmlspecialchars($challenge['solvetime']) ?></td>
                </tr>
                <?php $challCounter++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
