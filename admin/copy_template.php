<?php
/*
 * =========================
 * == Template Page
 * =========================
 * */

    ob_start();

    session_start();

    $pageTitle = '';

    if (isset($_SESSION['Username'])){

        include 'init.php';

        $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

        if ($do == 'Manage')
        {
            echo 'Hello';
        }

        /*===== ADD =====*/
        /*===== ADD =====*/
        /*===== ADD =====*/
        elseif ($do == 'Add')
        {}


        /*===== INSERT =====*/
        /*===== INSERT =====*/
        /*===== INSERT =====*/
        elseif ($do == 'Insert')
        {}

        /*===== EDIT =====*/
        /*===== EDIT =====*/
        /*===== EDIT =====*/
        elseif ($do == 'Edit')
        {}


        /*===== UPDATE =====*/
        /*===== UPDATE =====*/
        /*===== UPDATE =====*/
        elseif ($do == 'Update')
        {}

        /*===== ACTIVATE =====*/
        /*===== ACTIVATE =====*/
        /*===== ACTIVATE =====*/
        elseif ($do == 'Activate')
        {}

        include $tpl . 'footer.php';
    }

    else
    {
        header('Location: index.php');
        exit();
    }

    ob_end_flush();
?>