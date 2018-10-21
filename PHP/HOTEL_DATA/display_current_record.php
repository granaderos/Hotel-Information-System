<?php
	include  "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$sort_current_record_by = $_POST["sort_current_record_by"];
	
	$execute_display = new Hotel_data_functions();
	$execute_display->display_current_record($sort_current_record_by);
?>
