<?php
    include("../config/config.php");

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['retypepassword']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $retypepassword = $_POST['retypepassword'];
        $username = str_replace("::::", "", $username);
        if($password !== $retypepassword)
        {
            header("location:register.php?error=passwordsdonotmatch");
        }

        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $checkquery = "SELECT * FROM users WHERE username='$username';";
        $result = mysqli_query($conn, $checkquery);
	    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count == 0) 
        {
            $checkquery2 = "SELECT * FROM users WHERE email='$email';";
            $result2 = mysqli_query($conn, $checkquery2);
            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $count2 = mysqli_num_rows($result2);

            if ($count2 == 0) 
            {
                $query = "INSERT INTO users (username, password, email, team) VALUES ('$username', '$passwordhash', '$email', NULL);";
                $query_run = mysqli_query($conn, $query);

                if($query_run)
                {
                    header("location:login.php");
                }
                else
                {
                    header("location:register.php?error=adminerror");
                }
            }
            else
            {
                header("location:register.php?error=emailtaken");
            }
        }
        else
        {
            header("location:register.php?error=usernametaken");
        }

        
    }
    else
    {
        header("location:register.php?error=adminerror");
    }
?>
