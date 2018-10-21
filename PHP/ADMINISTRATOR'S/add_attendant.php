<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$data = $_POST["attendant_data"];
	$decoded_data = json_decode($data, true);
	
	foreach($decoded_data as $content) {
		$$content["name"] = $content["value"];
	}
	
	$execute_add = new Hotel_data_functions();
	$execute_add->add_attendant($attendant_firstname, $attendant_lastname, $attendant_gender, $attendant_age, $attendant_birth_month, $attendant_birth_date, $attendant_birth_year, $attendant_address, $attendant_contact_number, $attendant_username, $attendant_password);
