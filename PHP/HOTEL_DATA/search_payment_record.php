<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$name_entered = $_POST["payment_record_search_field"];
	
	$execute_search = new Hotel_data_functions();
	$execute_search->search_payment_record($name_entered);
