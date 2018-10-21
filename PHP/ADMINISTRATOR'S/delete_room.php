<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$id = $_POST["id"];
	
	$execute_delete = new Hotel_data_functions();
	$execute_delete->delete_room($id);
