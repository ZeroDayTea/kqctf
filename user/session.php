<?php
    session_start();
    
    if(!isset($_SESSION['logintoken'])) {
        session_unset();
        session_destroy();
        header("location:index.php");
        die();
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 172800)) {
        session_unset();
        session_destroy();
        header("location:index.php");
        die();
    }

    $_SESSION['LAST_ACTIVITY'] = time();
?>
