<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$attendant_id_to_delete = $_POST["attendant_id_to_delete"];
	
	$execute_delete = new Hotel_data_functions();
	$execute_delete->delete_attendant($attendant_id_to_delete);
