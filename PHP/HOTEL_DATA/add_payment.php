<?php
	
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$customer_id = $_POST["id"];
	$amount_to_pay = $_POST["amount_to_pay"];
	
	$execute_pay = new Hotel_data_functions();
	$execute_pay->add_payment($customer_id, $amount_to_pay);
