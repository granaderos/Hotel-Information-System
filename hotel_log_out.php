<?php
	session_start();
	
	if(isset($_SESSION["type_entered"])) {
		session_unset();
		session_destroy();
		header("Location: hotel_log_in_page.php");
	} else {
		header("Location: hotel_log_in_page.php");
	}
?>
