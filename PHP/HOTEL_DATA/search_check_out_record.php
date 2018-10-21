<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$name_entered = $_POST["name_entered"];
	
	$execute_search = new Hotel_data_functions();
	$execute_search->search_check_out_record($name_entered);
