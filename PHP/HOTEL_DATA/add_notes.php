<?php

	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$current_user_id = $_POST["current_user_id"];
	$note_about = $_POST["note_about"];
	$note_description = $_POST["note_description"];
	$current_time = $_POST["current_time"];
	
	$execute_add = new Hotel_data_functions();
	$execute_add->add_notes($current_user_id, $note_about, $note_description, $current_time);
