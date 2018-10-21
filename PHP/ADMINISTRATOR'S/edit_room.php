<?php
	
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	
	$room_data = $_POST["room_data"];
	$decoded_data = json_decode($room_data, true);
	$id = $_POST["id"];
	
	foreach($decoded_data as $content) {
		$$content["name"] = $content["value"];
	}
	
	$execute_update = new Hotel_data_functions();
	$execute_update->edit_room($id, $room_number, $room_type, $floor_number, $room_price, $room_status);
