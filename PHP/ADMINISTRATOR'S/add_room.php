<?php
	
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$data = $_POST["room_data"];
	$decoded_data = json_decode($data, true);
	
	foreach($decoded_data as $content) {
		$$content['name'] = $content['value'];
	}
	
	$execute_add = new Hotel_data_functions();
	$execute_add->add_room($room_number, $room_type, $floor_number, $room_price, $room_status);
