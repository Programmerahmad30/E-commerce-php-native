<?php

    //start The Session
    session_start();
    //Unset the Data
    session_unset();
    session_destroy();

    header('Location: index.php');
    exit();