<?php
	
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$execute_delete = new Hotel_data_functions();
	
	$id_array = $_POST["id"];
	$array_size = sizeof($id_array);
	$counter;
	
	for($counter = 0; $counter < $array_size; $counter++) {
		$execute_delete->delete_checked_out_record($id_array[$counter]);
	}
	
	
