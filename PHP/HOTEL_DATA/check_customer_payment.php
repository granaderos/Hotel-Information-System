<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$id = $_POST["id"];
	
	$execute_check = new Hotel_data_functions();
	$execute_check->check_customer_payment($id);
