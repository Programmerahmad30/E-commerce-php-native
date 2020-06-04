<?php


	include 'connect.php';

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

    //Include Navbar On All Pages Expect The One with $noNavbar Variabils
    if(!isset($noNavbar))
    {
        include $tpl . 'navbar.php';
    }

