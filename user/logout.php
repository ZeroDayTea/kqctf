<?php
    session_start();

    if(session_destroy()) {
        session_unset();
        session_destroy();
        header("location:/");
        die();
    }
?>
