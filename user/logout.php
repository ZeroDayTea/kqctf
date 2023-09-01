<?php
    // setting more secure session cookie properties
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_samesite', 'Strict');

    if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        ini_set('session.cookie_secure', 1);
    }

    session_name('session');

    session_start();

    if(session_destroy()) {
        session_unset();
        session_destroy();
        header("location:/");
        exit;
    }
?>
