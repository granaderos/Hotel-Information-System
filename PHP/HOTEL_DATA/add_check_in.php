<?php
	include "../FUNCTIONS_HOME/hotel_data_functions.php";

	$data = $_POST["data"];
	$decoded_data = json_decode($data, true);
	
	$payment_data = $_POST["payment_data"];
	$decoded_payment_data = json_decode($payment_data, true);

	$room_id = $_POST["id"];	
		
	foreach($decoded_payment_data as $payment) {
		$$payment['name'] = $payment['value'];
	}
		
	foreach($decoded_data as $content) {
		$$content['name'] = $content['value'];
	}
	
	$execute_add = new Hotel_data_functions();
	$execute_add->add_check_in($firstname, $lastname, $gender, $age, $contact_number, $address, $amount_given, $amount_to_pay, $room_id);
	
