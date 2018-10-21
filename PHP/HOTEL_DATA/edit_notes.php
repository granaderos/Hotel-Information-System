<?php
	
	include "../FUNCTIONS_HOME/hotel_data_functions.php";
	
	$id = $_POST["id"];
	$note_about = $_POST["note_about"];
	$note_description = $_POST["note_description"];
	$current_time = $_POST["current_time"];
	
	$execute_update = new Hotel_data_functions();
	$execute_update->edit_notes($id, $note_about, $note_description, $current_time);
