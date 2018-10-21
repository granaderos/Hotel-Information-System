<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$data = $_POST["data"];
	$decoded_data = json_decode($data, true);
	
	foreach($decoded_data as $content) {
		$$content['name'] = $content['value'];
	}
	
	$execute_get = new Hotel_data_functions();
	$execute_get->get_daily_total_income($payment_record_select_month, $payment_record_select_date, $payment_record_select_year);
