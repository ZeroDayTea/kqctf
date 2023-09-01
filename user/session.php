<?php
    // setting more secure session cookie properties
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_samesite', 'Strict');

    if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        ini_set('session.cookie_secure', 1);
    }

    session_name('session');

    session_start();

    // check for user session
    if(!isset($_SESSION['logintoken'])) {
        session_unset();
        session_destroy();
        header("location:/");
        exit;
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && ((time() - $_SESSION['LAST_ACTIVITY']) > 86400)) {
        session_unset();
        session_destroy();
        header("location:/");
        exit;
    }

    $_SESSION['LAST_ACTIVITY'] = time();

    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    error_reporting(0); // switch to E_ALL for dev instead of production
?>
