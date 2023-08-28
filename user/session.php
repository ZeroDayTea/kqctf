<?php
    session_start();
    if(!isset($_SESSION['logintoken'])) {
        session_unset();
        session_destroy();
        header("location:/");
        die();
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 172800)) {
        session_unset();
        session_destroy();
        header("location:/");
        die();
    }

    $_SESSION['LAST_ACTIVITY'] = time()
?>
