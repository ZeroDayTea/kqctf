<?php
    include("../config/config.php");
    include("../user/session.php");

    $checkedJSON = isset($_POST['checkedJSON'])?$_POST['checkedJSON']:'';
    $checkedArray = json_decode($_POST['checkedJSON']);
    $categoryNameArray = ["", "crypto", "forensics", "pwn", "rev", "web"];

    $username = $_SESSION['logintoken'];
    $teamquery = "SELECT team FROM users WHERE username='$username';";
    $teamresult = mysqli_query($conn, $teamquery);
    $teamrow = mysqli_fetch_array($teamresult, MYSQLI_ASSOC);
    $teamname = $teamrow['team'];

    $query = "SELECT challenges.category, challenges.challengename, challenges.challengeauthor, challenges.challengedescription, challenges.basescore, challenges.providedfile FROM challenges";
    $where = "";
    for($i = 1; $i < count($checkedArray); $i++)
    {
        if($checkedArray[$i])
        {
            if($where == "")
            {
                $where .= "category='" . $categoryNameArray[$i] . "'";
            }
            else
            {
                $where .= " OR category='" . $categoryNameArray[$i] . "'";
            }
        }
    }

    $join = "";

    if(!$checkedArray[0])
    {
        $join = " LEFT JOIN solvedchallenges ON solvedchallenges.challengename=challenges.challengename AND solvedchallenges.solvedbyteam='$teamname'";
    }

    if($join != "")
    {
        $query .= $join;
    }

    if($where == "")
    {
        if($join != "")
        {
            $query .= "WHERE solvedchallenges.solvedbyteam IS NULL AND challenges.released=true ORDER BY challenges.solves DESC;";
        }
        else
        {
            $query .= " WHERE challenges.released=true ORDER BY challenges.solves DESC;";
        }
    }
    else
    {
        if($join != "")
        {
            $query .= "WHERE solvedchallenges.solvedbyteam IS NULL AND challenges.released=true AND ($where) ORDER BY challenges.solves DESC;";
        }
        else
        {
            $query .= " WHERE " . $where . " AND challenges.released=true" . " ORDER BY challenges.solves DESC;";
        } 
    }

    $challengesHTML = "";
    $challengesresult = mysqli_query($conn, $query);
    while($challengerow = mysqli_fetch_array($challengesresult, MYSQLI_ASSOC))
    {
        $challengecategory = $challengerow['category'];
        $challengename = $challengerow['challengename'];
        $challengeauthor = $challengerow['challengeauthor'];
        $challengedescription = $challengerow['challengedescription'];
        $challengescore = $challengerow['basescore'];
        $challengefile = $challengerow['providedfile'];

        $solvecountquery = "SELECT * FROM solvedchallenges WHERE challengename='$challengename';";
        $solvecountresult = mysqli_query($conn, $solvecountquery);

        $solves = mysqli_num_rows($solvecountresult);

        $pointsvalue = CTFCCCFormula($challengescore, $solves);

        $challengesHTML .= "
        <div class='challengeBox' id='challengeBox'>
            <div class='row'>
            <div class='col-6'>
                <!--<div class='chal-category'> $challengecategory <br></div>-->
                <div class='chal-title' name='$challengename'> $challengename <br></div>
                <div class='chal-author'> $challengeauthor </div>
                </div>
                <div class='col-6 chal-leftcard'>
                <a href='ctfpage.php?page=challenges' target='_blank' class='chal-solves'> $solves solves /  $pointsvalue points</a>
                </div>
            </div>
            <div class='chal-divider'></div>
            <div class='chal-des'>
                $challengedescription
                <div class='input-group mb-3 chal-submit'>
                <input autocomplete='off' autocorrect='off' type='text' class='form-control' placeholder='kqctf{flag}' aria-label='Flag' aria-describedby='flag-btn-' style='background: #FAFAFA' name='flaginput' id='flaginput'>
                <div class='input-group-append''>
                    <button class='btn btn-outline-secondary' type='button' name='checkflagbtn' onClick='checkFlag(event);'>Submit</button>
                </div>
                </div>
            </div>
            ";
            if($challengefile != "" and !empty($challengefile))
            {
                $challengesHTML .= "
                <div class='chal-downloads'>
                <p style=\"margin-bottom: 3px;\">Downloads</p>
                <div class=\"tag-container\"><a href=\"./Public/$challengefile\" class=\"ctflink\" download=\"\">$challengefile</a></div>
                </div>
                ";
            }

            $challengesHTML .= "
            

            
            </div>
        </div>
        ";
    }

    echo $challengesHTML;
?>
