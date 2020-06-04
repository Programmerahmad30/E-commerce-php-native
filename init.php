<?php

    //Error Reporting

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

	include 'admin/connect.php';

	$sessionUser = '';
	if (isset($_SESSION['user']))
    {
        $sessionUser = $_SESSION['user'];
    }

	/*
	 * Routes
	 * Template Directory
	 * CSS Directory
	 * JS Directory
	 * Languages Directory
	 * Functions Directory
	 * */

	$tpl  = 'includes/templates/';
    $lang = 'includes/languages/';
    $fun  = 'includes/functions/';
	$css  = 'layout/css/';
	$js   = 'layout/js/';


	//Include The Important Files
    include $fun  . 'functions.php';
    include $lang . 'english.php';
    include $tpl  . 'header.php';
