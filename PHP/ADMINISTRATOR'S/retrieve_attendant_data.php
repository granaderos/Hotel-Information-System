<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$attendant_id_to_edit = $_POST["attendant_id_to_edit"];
	
	$execute_retrieve = new Hotel_data_functions();
	$execute_retrieve->retrieve_attendant_data($attendant_id_to_edit);
