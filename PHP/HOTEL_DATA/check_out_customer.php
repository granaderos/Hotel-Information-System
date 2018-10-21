<?php
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$id = $_POST["id"];
	$current_time = $_POST["current_time"];
	
	$execute_check_out = new Hotel_data_functions();
	$execute_check_out->check_out_customer($id, $current_time);
	
?>
