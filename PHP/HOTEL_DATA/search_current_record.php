<?php
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	
	$execute_search = new Hotel_data_functions();
	$execute_search->search_current_record($firstname, $lastname);
