<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$id = $_POST["id"];
	
	$execute_retrieve = new Hotel_data_functions();
	$execute_retrieve->retrieve_room_data($id);
