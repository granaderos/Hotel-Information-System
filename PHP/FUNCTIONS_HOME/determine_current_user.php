<?php
	
	session_start();
	
	include "users_functions.php";
	
	$username = $_SESSION["username_entered"];
	$execute_determine = new Users_functions();
	$execute_determine->determine_current_user($username);
