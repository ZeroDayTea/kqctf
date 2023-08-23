<?php
    include("../user/session.php");
    include("../config/config.php");

    $challengequery = "SELECT * FROM challenges WHERE released=true;";
    $challengeresult = mysqli_query($conn, $challengequery);
    $count = 0;
    $cryptocount = 0;
    $forensicscount = 0;
    $pwncount = 0;
    $revcount = 0;
    $webcount = 0;

    $username = $_SESSION['logintoken'];
    $teamquery = "SELECT team FROM users WHERE username='$username';";
    $teamresult = mysqli_query($conn, $teamquery);
    $teamrow = mysqli_fetch_array($teamresult, MYSQLI_ASSOC);
    $team = $teamrow['team'];

    while($challengerow = mysqli_fetch_array($challengeresult, MYSQLI_ASSOC))
    {
      $count += 1;
      if($challengerow["category"] == 'crypto')
      {
        $cryptocount += 1;
      }
      else if($challengerow["category"] == 'forensics')
      {
        $forensicscount += 1;
      }
      else if($challengerow["category"] == 'pwn')
      {
        $pwncount += 1;
      }
      else if($challengerow["category"] == 'rev')
      {
        $revcount += 1;
      }
      else if($challengerow["category"] == 'web')
      {
        $webcount += 1;
      }
    }

    $solvedquery = "SELECT * FROM solvedchallenges WHERE solvedbyteam=$team;";
    $solvedresult = mysqli_query($conn, $solvedquery);
    $solvedcount = 0;
    $solvedcryptocount = 0;
    $solvedforensicscount = 0;
    $solvedpwncount = 0;
    $solvedrevcount = 0;
    $solvedwebcount = 0;

    while($solvedrow = mysqli_fetch_array($solvedresult, MYSQLI_ASSOC))
    {
      $challname = $solvedrow['challengename'];
      $solvedchallengequery = "SELECT * FROM challenges WHERE released=true AND challengename='$challname';";
      $solvedchallengeresult = mysqli_query($conn, $challengequery);
      $solvedchallengerow = mysqli_fetch_array($solvedchallengeresult, MYSQLI_ASSOC);

      $solvedcount += 1;
      if($solvedchallengerow["category"] === 'crypto')
      {
        $solvedcryptocount += 1;
      }
      else if($solvedchallengerow["category"] === 'forensics')
      {
        $solvedforensicscount += 1;
      }
      else if($solvedchallengerow["category"] === 'pwn')
      {
        $solvedpwncount += 1;
      }
      else if($solvedchallengerow["category"] === 'rev')
      {
        $solvedrevcount += 1;
      }
      else if($solvedchallengerow["category"] === 'web')
      {
        $solvedwebcount += 1;
      }
    }

    $total = "Include Solved " . "($solvedcount" . "/" . "$count solved)";
    $crypto = "crypto ($solvedcryptocount" . "/" . "$cryptocount solved)";
    $forensics = "forensics ($solvedforensicscount" . "/" . "$forensicscount solved)";
    $pwn = "pwn ($solvedpwncount" . "/" . "$pwncount solved)";
    $rev = "rev ($solvedrevcount" . "/" . "$revcount solved)";
    $web = "web ($solvedwebcount" . "/" . "$webcount solved)";

    $solves = [$total, $crypto, $forensics, $pwn, $rev, $web];
    print json_encode($solves);
?>
