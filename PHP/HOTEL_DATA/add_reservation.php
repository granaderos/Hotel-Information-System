<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$room_id = $_POST["id"];
	$reserve_to_firstname = $_POST["reserve_to_firstname"];
	$reserve_to_lastname = $_POST["reserve_to_lastname"];
	
	$execute_reserve = new Hotel_data_functions();
	$execute_reserve->add_reservation($room_id, $reserve_to_firstname, $reserve_to_lastname);
