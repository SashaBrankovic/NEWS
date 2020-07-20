<?php
	include_once "class/logout.class.php";
	session_start();
	$logout = new Logout();
	$logout->LogoutUser();
?> 
