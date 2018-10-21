<?php
	
	session_start();

	if(!isset($_SESSION["username_entered"])) {
		header("Location: hotel_log_in_page.php");
	}
?>

<!Doctype html>
<html>
	<head>
		<title>Administrator's page</title>
		<script src = "JS/jquery-1.9.1.min.js"></script>
        <script src = "JS/jquery-ui-1.10.2.min.js"></script>
        <script src = "JS/bootstrap.min.js"></script>
        <script src = "JS/admin_hotel_data.js"></script>
        <script src = "JS/admin_hotel_page_functionality.js"></script>
        <link rel = "stylesheet" href = "CSS/admin_hotel_page.css" />
        <link rel = "stylesheet" href = "CSS/jquery-ui.min.css" />
        <link rel = "shortcut icon" href = "CSS/images/t.jpeg" />
	</head>
	<body>
		<div id = "admin_container_div">
		
			<h1>Hotel Management & Customer Enlistment System</h1><br />
			<div id = "admin_navigator_tabs_div">
				<ul id = "navigator_ul">
					<li><a href = "#admin_attendants_div" id = "admin_attendants_a">ATTENDANTS</a></li>
					<li><a href = "#admin_all_rooms_div" id = "admin_all_rooms_a">ROOMS</a></li>
					<li><a href = "#admin_notes_div" id = "admin_notes_a">NOTES</a></li>
					<a href = "hotel_log_out.php" id = "admin_log_out_a">SIGN OUT</a>
				</ul>
			
				<div id = "admin_notes_div">
					<center><button class = "admin_button" id = "add_notes_button">ADD NOTES</button></center><br />
		     		<div id = "add_notes_div">
		     			<center><accr title = "close"><img src = "CSS/images/close.png" id = "close_note"/></accr></center>
		     			<form>
				  			<table>
				  				<tr>
				  					<td>About:</td><td><input type = "text" id = "note_about" name = "note_about" /></td>
				  				</tr>
				  				<tr>
				  					<td></td><td><textarea id = "note_description" name = "note_description" placeholder = "Note description"></textarea></td>
				  				</tr>
				  			</table>
				  			<p class = "warning" id = "note_warning">Something is missing! :P</p>
		     				<center><input type = "button" id = "post_note_button" value = "POST" /><input type = "reset" id = "save_note_button" value = "save" /></center>
		     			</form><br />
		     		</div><!-- add notes div -->
		     		<div id = "delete_note_confirmation" title = "DELETE CONFIRMATION">
						<img src = "CSS/images/delete1.png" />Are you sure to delete this NOTE? It can not be restored later!
					</div><!-- delete note confirmation ends -->
		     		<div id = "all_notes_div"></div>
				</div>
				
				<div id = "admin_attendants_div">
					<center><button class = "admin_button" id = "add_attendant_button">ADD ATTENDANT</button><button class = "admin_button" id = "delete_attendant_button">REMOVE ATTENDANT</button><button class = "admin_button" id = "edit_attendant_button">UPDATE ATTENDANT'S INFO</button></center><br />
					<table id = "admin_attendants_table" border = "1">
					</table>
					<div id = "add_attendant_div" title = "ADD ATTENDANT" >
						<form id = "attendant_form">
							<fieldset>
								<legend>ATTENDANT'S INFORMATION FORM</legend>
								<table>
									<tr>
										<td>First name:</td><td><input type = "text" name = "attendant_firstname" id = "attendant_firstname"></td><td>Last name:</td><td><input type = "text" name = "attendant_lastname" id = "attendant_lastname"></td>
									</tr>
									<tr>
										<td>Gender:</td><td><select name = "attendant_gender" id = "attendant_gender"><option id = 'select_gender'>select gender</option><option>Female</option><option>Male</option></select></td><td>Age:</td><td><input type = "number" name = "attendant_age" id = "attendant_age"></td>
									</tr>
									<tr>
										<td>Birthday:</td><td><select id = "attendant_birth_month" name = "attendant_birth_month"></select><select name = "attendant_birth_date" id = "attendant_birth_date"></select><select name = "attendant_birth_year" id = "attendant_birth_year"></select></td><td>Address:</td><td><input type = "text" name = "attendant_address" id = "attendant_address"></td>
									</tr>
									<tr>
										<td>Contact Number: </td><td><input type = "text" name = "attendant_contact_number" id = "attendant_contact_number"></td>
									</tr>
									<tr>
										<td>ATTENDANT'S USERNAME:</td><td><input type = "text" name = "attendant_username" id = "attendant_username"></td><td>ATTENDANT'S PASSWORD: </td><td><input type = "password" name = "attendant_password" id = "attendant_password"></td>
									</tr>
								</table>
								<button id = "clear_all_attendant_info" type = "reset"><img src = "CSS/images/clear_all2.png" /></button>
							</fieldset>
						</form>
						<p class = "warning" id = "invalid_attendant_data_warning">Please check the inputted data  and fill up all required info. Thank you.</p>
					</div><!-- add attendant div ends -->
					<div id = "delete_attendant_div" title = "REMOVE ATTENDANT">
						Attendant's ID: <input type = "text" name = "attendant_id_to_delete" id = "attendant_id_to_delete" />
						<p class = "warning" id = "id_to_delete_does_not_exist">ID doesn't exist!</p>
						<p class = "warning" id = "invalid_id_to_delete">Please check Attendant's ID!</p>
						<p id = "remove_attendant_confirmation" title = "DELETE CONFIRMATION"><img src = "CSS/images/warning9.png">Are you sure to delete this Attendant?</p>
					</div><!-- delete attendant div ends-->
					<div id = "edit_attendant_div" title = "UPDATE ATTENDANT'S INFO">
						Attendant's ID: <input type = "text" name = "attendant_id_to_edit" id = "attendant_id_to_edit" />
						<p class = "warning" id = "id_to_edit_does_not_exist">ID doesn't belong to any Attendant!</p>
						<p class = "warning" id = "invalid_id_to_edit">Please check Attendant's ID!</p>
					</div><!-- edit attendant info div -->
			 	</div><!-- admin users div ends -->
	
				<div id = "admin_all_rooms_div">
					<center><button class = "admin_button" id = "admin_add_room_button">ADD ROOM</button></center><br/><br/>
					<div id = "delete_room_confirmation" title = "DELETE ROOM CONFIRMATION">
						<img src = "CSS/images/warning2.png" /> &nbsp;&nbsp;&nbsp;Hey! Are you sure to delete this room?
					</div>
					<table id = "admin_all_rooms_table" border = "1">
					</table>
					<div id = "admin_add_room_div" title = "ADD ROOM">
						<form id = "admin_room_form">
							<table>
								<tr>
									<td>ROOM No. </td><td><input type = "text" name = "room_number" id = "room_number"></td>
								</tr>
								<tr>
									<td>FLOOR No. </td><td><input type = "number" name = "floor_number" id = "floor_number"></td>
								</tr>
								<tr>
									<td>TYPE: </td><td><select name = "room_type" id = "room_type"><option>single bed room</option><option>double bed room</option><option>twin bed room</option><option>family-size bed room</option></select></td>
								</tr>
								<tr>
									<td>ROOM PRICE:</td><td>&#8369;<input type = "number" name = "room_price" id = "room_price" class = "peso_field" /></td>
								</tr>
								<tr>
									<td>STATUS: </td><td><select name = "room_status" id = "room_status"><option>available</option><option>reserved</option><option>occupied</option><option>out of order</option></select></td>
								</tr>	
							</table>
							<p class = "warning" id = "invalid_room_data_warning">Please check the inputted data. Thank you.</p>
						</form>
					</div><!-- admin add rooms div -- >
					
				</div> <!-- all rooms div -->
				
			</div> <!-- div tabs menu -->
		</div><!-- admin container page -->
		
		<!-- hidden inputs -->
		
		<input type = "hidden" name = "id" id = "id" />
		<input type = "hidden" name = "current_user_id" id = "current_user_id" />
		<input type = "hidden" name = "current_time" id = "current_time" />
	</body>
</html>
