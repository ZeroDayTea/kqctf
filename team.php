<?php

      $username = $_SESSION['logintoken'];
      $query = "SELECT * FROM users WHERE username='$username';";
      $result = mysqli_query($conn, $query);
      $userrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $team = $userrow['team'];

      if($userrow['verified'] == false || !isset($userrow['verified']) || empty($userrow['verified']))
      {
        echo '
        <div class="col-lg-6 center" >
            <form class="input-forms" action="./verifyteams.php" method="post">
              <div class="section-title">
                <h3><span>Team Verification:</span></h3>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="teampassword" placeholder="Team Password" required>
              </div>
              <br>
              <div class="text-center"><button type="submit" class="btn btn-primary">Verify</button></div>';
              if(isset($_GET['error']) && $_GET['error'] == 'incorrectjoin') {echo '<br><h5 style="color:red; text-align:center"> Username/Password combination is incorrect </h5>';}
              if(isset($_GET['error']) && $_GET['error'] == 'adminerrorjoin') {echo '<br><h5 style="color:red; text-align:center"> Something went wrong. Please contact an admin </h5>';}
              if(isset($_GET['error']) && $_GET['error'] == 'teamfull') {echo '<br><h5 style="color:red; text-align:center"> That team is full </h5>';}
              echo '
            </form>
          </div> ';
      }
      else
      {
        if(!isset($team) || empty($team))
        {
        echo '
        <section id="login" class="login" >
        <div class="container" data-aos="fade-up">
        <div class="row" data-aos="fade-up" data-aos-delay="100" >
          <!--<div class="col-lg-6 center" >
            <form class="input-forms" action="./registerteamsub.php" method="post">
            <div class="section-title">
              <h3><span>Register New Team:</span></h3>
            </div>
              <div class="row">
                <label class="form-label text-center"> Team Credentials </label>
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
              <div class="row">
                <label class="form-label text-center"> Team Eligibility </label>
                <div class="col form-group">
                  <select class="form-control" name="teamleaderboard" id="teamleaderboard">
                    <option value="Open/College Division">Open/College Division</option>
                    <option value="High School Division">High School Division</option>
                    <option value="Middleschool Division">Middle School Division</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="text-center"><button type="submit" class="btn btn-primary">Register</button></div>';
              if(isset($_GET['error']) && $_GET['error'] == 'usernametaken') {echo '<br><h5 style="color:red; text-align:center"> Username is already taken </h5>';}
              if(isset($_GET['error']) && $_GET['error'] == 'teamnametaken') {echo '<br><h5 style="color:red; text-align:center"> A team with that team name already exists </h5>';}
              if(isset($_GET['error']) && $_GET['error'] == 'passwordsdonotmatch') {echo '<br><h5 style="color:red; text-align:center"> Passwords do not match </h5>';}
              if(isset($_GET['error']) && $_GET['error'] == 'adminerror') {echo '<br><h5 style="color:red; text-align:center"> Something went wrong. Please contact an admin </h5>';}
              echo '
            </form>
          </div>-->
          
          <div class="col-lg-6 center" >
            <form class="input-forms" action="./jointeamsub.php" method="post">
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
              <br>
              <div class="text-center"><button type="submit" class="btn btn-primary">Join</button></div>';
              if(isset($_GET['error']) && $_GET['error'] == 'incorrectjoin') {echo '<br><h5 style="color:red; text-align:center"> Username/Password combination is incorrect </h5>';}
              if(isset($_GET['error']) && $_GET['error'] == 'adminerrorjoin') {echo '<br><h5 style="color:red; text-align:center"> Something went wrong. Please contact an admin </h5>';}
              if(isset($_GET['error']) && $_GET['error'] == 'teamfull') {echo '<br><h5 style="color:red; text-align:center"> That team is full </h5>';}
              echo '
            </form>
          </div>  
        </div>
      </div>
      </section>
        ';
      }
      else
      {
        $query = "SELECT * FROM teams WHERE teamname='$team';";
        $result = mysqli_query($conn, $query);
        $teamrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $teamname = htmlspecialchars($teamrow['teamname'], ENT_QUOTES, 'UTF-8');
        $leaderboardteam = htmlspecialchars($teamrow['leaderboard'], ENT_QUOTES, 'UTF-8');

        $membersquery = "SELECT username FROM users WHERE team='$team';";
        $teamresult = mysqli_query($conn, $membersquery);

        $solvedchallsquery = "SELECT * FROM solvedchallenges WHERE solvedbyteam='$team';";
        $solvedchallsresult = mysqli_query($conn, $solvedchallsquery);
        
        echo "
        <div class=\"section-title\">
        <h2>Team Information: </h2>
        <h3>Team:  $teamname   </h3>
        <h5>Leaderboard: $leaderboardteam</h5>
        </div>
        <div class=\"col-6 center\" style=\"min-height: 230px;\">
        <table class=\"table scoreboard\" style=\"border: none; background-color: white;\">
        <thead style=\"text-align: center;\">
          <tr>
            <th style=\"width: 4em;border-top: none;\">#</th>
            <th style=\"border-top: none;\">Member</th>
          </tr>
        </thead>
        <tbody style=\"text-align: center;\" id=\"sc-teams\">
        ";
        $counter = 1;
        while($teamrow = mysqli_fetch_array($teamresult, MYSQLI_ASSOC))
        {
          $user = htmlspecialchars($teamrow['username'], ENT_QUOTES, 'UTF-8');
          echo "
          <tr>
          <th style=\"font-weight:normal;\">$counter</th>
          <th style=\"font-weight:normal;\">$user</th>
          </tr>
          ";
          $counter += 1;
        }
        echo "
      </tbody>
    </table>
        <br><br>
        <table class=\"table scoreboard\" style=\"border: none; background-color: white;\">
            <thead style=\"text-align: center;\">
              <tr>
                <th style=\"width: 4em;border-top: none;\">#</th>
                <th style=\"border-top: none;\">Solved</th>
                <th style=\"width: 12em;border-top: none\">Time</th>
              </tr>
            </thead>
            <tbody style=\"text-align: center;\" id=\"sc-teams\">
            ";
            $challscounter = 1;
            while($challrow = mysqli_fetch_array($solvedchallsresult, MYSQLI_ASSOC))
            {
              $challname = htmlspecialchars($challrow['challengename'], ENT_QUOTES, 'UTF-8');
              $solvetime = htmlspecialchars($challrow['solvetime'], ENT_QUOTES, 'UTF-8');
              echo "
              <tr>
              <th style=\"font-weight:normal;\">$challscounter</th>
              <th style=\"font-weight:normal;\">$challname</th>
              <th style=\"font-weight:normal;\">$solvetime</th>
              </tr>
              ";
              $challscounter += 1;
            }
              
          echo "
            </tbody>
          </table>
        </div>
        ";
      }
      } 
?>
