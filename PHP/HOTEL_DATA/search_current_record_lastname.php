<?php
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$name_entered = $_POST["search_current_record_lastname_field"];
	$name_entered = $name_entered."%";
	$execute_search = new Hotel_data_functions();
	$execute_search->search_current_record_lastname($name_entered);
