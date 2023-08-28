<?php
    include("../config/config.php");

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['retypepassword']) && isset($_POST['competingwith']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];
        $retypepassword = $_POST['retypepassword'];
        $competingwith = $_POST['competingwith'];

        if($password != $retypepassword)
        {
            header("location:/user/register?error=passwordsdonotmatch");
        }

        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $checkusername = $conn->prepare("SELECT * FROM users WHERE username=?;");
        $checkusername->bind_param("s", $username);
        $checkusername->execute();
        $row = $checkusername->get_result()->fetch_assoc();
        $usernamecount = $checkusername->affected_rows;
        $checkusername->close();

        if ($usernamecount == 0)
        {
            $checkemail = $conn->prepare("SELECT * FROM users WHERE email=?;");
            $checkemail->bind_param("s", $email);
            $checkemail->execute();
            $emailrow = $checkemail->get_result()->fetch_assoc();
            $emailcount = $checkemail->affected_rows;
            $checkemail->close();

            if ($emailcount == 0)
            {
                $teamid = NULL;

                // if competing solo then create solo team
                if($competingwith === "solo")
                {
                    $insertteam = $conn->prepare("INSERT INTO teams (teamname, password, points, mostrecentsoltime) VALUES (?, ?, 0, NULL);");
                    $insertteam->bind_param("ss", $username, $passwordhash);
                    $insertteam->execute();
                    $teamid = $conn->insert_id;
                    $insertteam->close();
                }

                $insertuser = $conn->prepare("INSERT INTO users (username, password, email, team) VALUES (?, ?, ?, ?);");
                $insertuser->bind_param("sssi", $username, $passwordhash, $email, $teamid);

                if($insertuser->execute())
                {
                    $insertuser->close();
                    header("location:/user/login");
                }
                else
                {
                    $insertuser->close();
                    header("location:/user/register?error=adminerror");
                }
            }
            else
            {
                header("location:/user/register?error=emailtaken");
            }
        }
        else
        {
            header("location:/user/register?error=usernametaken");
        }
    }
    else
    {
        header("location:/user/register");
    }
?>
