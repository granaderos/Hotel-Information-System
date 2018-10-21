<?php
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$sort_checked_out_record_by = $_POST["sort_checked_out_record_by"];
	
	$execute_display = new Hotel_data_functions();
	$execute_display->display_checked_out_record($sort_checked_out_record_by);
?>
