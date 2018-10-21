$(document).ready(function(){
	
	display_all_rooms();
	display_attendants();
	display_notes();
	determine_current_user();
	get_current_time();
	
	$("#admin_add_room_button").click(function() {
	 	$("#admin_add_room_div").dialog({
	 		show: {effect: "slide", direction: "up"},
			hide: {effect: "slide", direction: "up"},
	 		modal: true,
	 		draggable: false,
	 		resizable: false,
	 		width: 600,
	 		height: 350,
	 		buttons: {
	 			"SUBMIT": function() {
	 				var integer_pattern = /^[0-9]*$/;
	 				var room_number = $("#room_number").val();
	 				var floor_number = $("#floor_number").val();
	 				var room_price = $("#room_price").val();
	 				var room_number_valid = integer_pattern.test(room_number);
	 				var floor_number_valid = integer_pattern.test(floor_number);
	 				var room_price_valid = integer_pattern.test(room_price);
	 				if(room_number != "" && room_number_valid && floor_number != "" && floor_number_valid && room_price != "" && room_price_valid) {
		 				$.ajax({
		 					type: "POST",
		 					url: "PHP/ADMINISTRATOR'S/add_room.php",
		 					data: {"room_data": JSON.stringify($("#admin_room_form").serializeArray())},
		 					success: function(data) {
		 						display_all_rooms();
		 						$("#admin_add_room_div").dialog("close");
		 					},
		 					error: function(data) {
		 						console.log("error in adding room = " + JSON.strngify(data));
		 					}
		 				});
		 			} else {
		 				$("#invalid_room_data_warning").show();
		 				$("#invalid_room_data_warning").fadeOut(6000);
		 			}
	 			},
	 			"CANCEL": function() {
	 				$(this).dialog("close");
	 			}
	 		}
	 	});
	 });
	 
	 $("#add_attendant_button").click(function(){
	 	$("#add_attendant_div").dialog({
	 		show: {effect: "slide", direction: "up"},
	 		hide: {effect: "slide", direction: "up"},
	 		modal: true,
	 		draggable: false,
	 		resizable: false,
	 		width: 800,
	 		buttons: {
	 			"ADD": function() {
	 				var string_pattern = /^[a-z, A-Z, -]*$/;
	 				var integer_pattern = /^[0-9]*$/;
	 				
	 				var firstname = $("#attendant_firstname").val();
	 				var lastname = $("#attendant_lastname").val();
	 				var age = $("#attendant_age").val();
	 				var address = $("#attendant_address").val();
	 				var contact_number = $("#attendant_contact_number").val();
	 				var username = $("#attendant_username").val();
	 				var password = $("#attendant_password").val();
	 				
	 				var firstname_valid = string_pattern.test(firstname);
	 				var lastname_valid = string_pattern.test(lastname);
	 				var age_valid = integer_pattern.test(age);
	 				var contact_number_valid = integer_pattern.test(contact_number);
	 				var username_valid = string_pattern.test(username);
	 				
	 				if(firstname != "" && firstname_valid && lastname != "" && lastname_valid && age != "" && age_valid && address != "" && contact_number != "" && contact_number_valid && contact_number.length == 11 && username != "" && username_valid && password != "") {
		 				$.ajax({
		 					type: "POST",
		 					url: "PHP/ADMINISTRATOR'S/add_attendant.php",
		 					data: {"attendant_data": JSON.stringify($("#attendant_form").serializeArray())},
		 					success: function(data) {
								if(data != "") {
									alert(data);
								} else {
									display_attendants();
									$("#add_attendant_div").dialog("close");
								}
							},
		 					error: function(data) {
		 						console.log("error in ading attendant = " + JSON.stringify(data));
		 					}
		 				});
		 			} else {
		 				$("#invalid_attendant_data_warning").show();
		 				$("#invalid_attendant_data_warning").fadeOut(8000);
		 			}
	 			},
	 			"CANCEL": function() {
		 			$(this).dialog("close");
		 		}
		 	}
	 	});
	 });
	 
	 $("#delete_attendant_button").click(function() {
	 	$("#delete_attendant_div").dialog({
	 		show: {effect: "slide", direction: "up"},
			hide: {effect: "slide", direction: "up"},
	 		modal: true,
	 		draggable: false,
	 		resizable: false,
	 		height: 250,
	 		buttons: {
	 			"REMOVE": function() {
	 				var integer_pattern = /^[0-9]*$/;
	 				var id_to_delete = $("#attendant_id_to_delete").val();
	 				var id_valid = integer_pattern.test(id_to_delete);
	 				if(id_to_delete != "" && id_valid) {
		 				$("#remove_attendant_confirmation").dialog({
		 					show: {effect: "slide", direction: "up"},
							hide: {effect: "slide", direction: "up"},
					 		modal: true,
							resizable: false,
							draggable: false,
					 		buttons: {
					 			"YES": function() {
					 				$(this).dialog("close");
					 				$.ajax({
					 					type: "POST",
					 					url: "PHP/ADMINISTRATOR'S/delete_attendant.php",
					 					data: {"attendant_id_to_delete": id_to_delete},
					 					success:	function(data) {
					 						if(data == "") {
						 						var id = $("#attendant_id_to_delete").val();
						 						$("#attendant_" + id).remove();
						 						$("#delete_attendant_div").dialog("close");
						 					} else {
						 						$("#id_to_delete_does_not_exist").show();
						 						$("#id_to_delete_does_not_exist").fadeOut(6000);
						 					}
					 					},
					 					error: function(data) {
					 						console.log("error in deleting attendant = " + JSON.stringify(data));
					 					}
					 				});
				 			},
				 			"NO": function() {
				 				$(this).dialog("close");
				 			}
				 		}
	 				});
	 			}else {
	 				$("#invalid_id_to_delete").show();
					$("#invalid_id_to_delete").fadeOut(6000);
	 			}
		 				
	 			},
	 			"CANCEL": function() {
	 				$(this).dialog("close");
	 			}
	 		}
	 	});
	 });
	
	$("#edit_attendant_button").click(function() {
		$("#edit_attendant_div").dialog({
			show: {effect: "slide", direction: "up"},
			hide: {effect: "slide", direction: "up"},
			height: 230,
			width: 340,
			modal: true,
			draggable: false,
	 		resizable: false,
			buttons: {
				"SUBMIT": function() {
					var integer_pattern = /^[0-9]*$/;
	 				var id_to_edit = $("#attendant_id_to_edit").val();
	 				var id_valid = integer_pattern.test(id_to_edit);
	 				if(id_to_edit != "" && id_valid) {
						$.ajax({
							type: "POST",
							url:"PHP/ADMINISTRATOR'S/retrieve_attendant_data.php",
							data: {"attendant_id_to_edit": $("#attendant_id_to_edit").val()},
							success: function(data) {
								if(data == "") {
									$("#id_to_edit_does_not_exist").show();
									$("#id_to_edit_does_not_exist").fadeOut(6000);
								} else {
									var parsed_data = JSON.parse(data);
									$("#attendant_firstname").val(parsed_data.firstname);
									$("#attendant_lastname").val(parsed_data.lastname);
									$("#attendant_gender").val(parsed_data.gender);
									$("#attendant_age").val(parsed_data.age);
									$("#attendant_address").val(parsed_data.address);
									$("#attendant_contact_number").val(parsed_data.contact_number);
									$("#attendant_username").val(parsed_data.username);
									$("#attendant_password").val(parsed_data.password);
									$("#id").val(parsed_data.user_id);
								
									$("#add_attendant_div").dialog({
										title: "UPDATE ATTENDANT'S INFO",
								 		show: {effect: "slide", direction: "up"},
								 		hide: {effect: "slide", direction: "up"},
								 		modal: true,
								 		draggable: false,
		 								resizable: false,
								 		width: 800,
								 		open: function() {
								 			$("#edit_attendant_div").dialog("close");
								 		},
								 		buttons: {
								 			"SAVE": function() {
								 				$.ajax({
								 					type: "POST",
								 					url: "PHP/ADMINISTRATOR'S/edit_attendant.php",
								 					data: {"id": $("#id").val(),"attendant_data": JSON.stringify($("#attendant_form").serializeArray())},
								 					success: function(data) {
								 						display_attendants();
								 						$("#add_attendant_div").dialog("close");							 					},
								 					error: function(data) {
								 						console.log("error in editing attendant's info = " + JSON.stringify(data));
								 					}
								 				});
								 			},
								 			"CANCEL": function() {
									 			$(this).dialog("close");
									 		}
									 } // buttons of add attendant dialog
								 }); // end of add attendant dialog 
								} //else statement ends
							}, // success function ends
							error: function(data) {
								console.log("error in retrieving attendant's data = " + JSON.stringify(data));
							}
						});
					} else {
						$("#invalid_id_to_edit").show();
						$("#invalid_id_to_edit").fadeOut(6000);
					}
				},// submit function ends! 
				"CANCEL": function() {
					$(this).dialog("close");
				}
			} //buttons edit dialog
		}); 
	});
	
	$("#post_note_button").click(function() {
		if($("#note_about").val() != "" && $("#note_description").val() != "") {
			$.ajax({
				type: "POST",
				url: "PHP/HOTEL_DATA/add_notes.php",
				data: {"current_user_id": $("#current_user_id").val(), "note_about": $("#note_about").val(), "note_description": $("#note_description").val(), "current_time": $("#current_time").val()},
				success: function(data) {
					if(data != "") {
						$("#all_notes_div").prepend(data);
						$("#add_notes_div").slideUp();
					} else {
						$("#note_warning").show();
						$("#note_warning").fadeOut(6000);
					}
				},
				error: function(data) {
					console.log("error in adding notes = " + JSON.stringify(data));
				}
			});
		}
	});
	
	$("#save_note_button").click(function() {
		$.ajax({
			type: "POST",
			url: "PHP/HOTEL_DATA/edit_notes.php",
			data: {"id": $("#id").val(), "note_about": $("#note_about").val(), "note_description": $("#note_description").val(), "current_time": $("#current_time").val()},
			success: function(data) {
				var id = $("#id").val();
				$("#note_" + id).html(data);
				$("#add_notes_div").slideUp();
				$("#save_note_button").hide();
				$("#post_note_button").show();
			},
			error: function(data) {
				console.log("error in editing notes = " + JSON.stringify(data));
			}
		});
	});
	
});

function determine_current_user() {
	$.ajax({
		url: "PHP/FUNCTIONS_HOME/determine_current_user.php",
		success: function(data) {
			var parsed_data = JSON.parse(data);
			$("#current_user_id").val(parsed_data.user_id);
			$("#attendant_span").append(parsed_data.user_fullname);
		},
		error: function(data) {
			console.log("error in determining current user = " + JSON.stringify(data))
		}
	});
}


function display_notes() {
	$.ajax({
		url: "PHP/HOTEL_DATA/display_notes.php",
		success: function(data) {
			$("#all_notes_div").html(data);
		},
		error: function(data) {
			console.log("error in displaying note = " + JSON.stringify(data));
		}
	});
}

function edit_note(id){
	$("#post_note_button").hide();
	$("#save_note_button").show();
	$.ajax({
		type: "POST",
		url: "PHP/HOTEL_DATA/retrieve_notes.php",
		data: {"id": id},
		success: function(data) {
			var parsed_data = JSON.parse(data);
			$("#note_about").val(parsed_data.note_about);
			$("#note_description").val(parsed_data.note_description);
			$("#id").val(parsed_data.note_id);
			$("#add_notes_div").slideDown();
		},
		error: function(data) {
			console.log("error in retrieving notes to edit = " + JSON.stringify(data));
		}
	});
}

function delete_note(id) {
	$("#delete_note_confirmation").dialog({
		show: {effect: "slide", direction: "left"},
		hide: {effect: "slide", direction: "left"},
		modal: true,
		buttons: {
			"YES": function() {
				$.ajax({
					type: "POST",
					url: "PHP/HOTEL_DATA/delete_notes.php",
					data: {"id": id},
					success: function() {
						$(document.getElementById('note_' + id)).remove();
						$("#delete_note_confirmation").dialog("close");
					},
					error: function(data) {
						console.log("error in deleteting notes = " + JSON.stringify(data));
					} 
				});
			},
			"NO": function() {
				$(this).dialog("close");
			}
		}
	});
	
}

function display_all_rooms() {
	$.ajax({
		url: "PHP/ADMINISTRATOR'S/admin_display_all_rooms.php",
		success: function(data) {
			$("#admin_all_rooms_table").html(data);
		},
		error: function(data) {
			console.log("error in displaying all rooms in administrator's page. = " + JSON.stringify(data));
		}
	});
}

function edit_room(id) {
	$.ajax({
		type: "POST",
		url: "PHP/ADMINISTRATOR'S/retrieve_room_data.php",
		data: {"id": id},
		success: function(data) {
			var parsed_data = JSON.parse(data);
			
			$("#id").val(parsed_data.room_id);
			$("#room_number").val(parsed_data.room_number);
			$("#floor_number").val(parsed_data.floor_number);
			$("#room_type").val(parsed_data.room_type);
			$("#room_price").val(parsed_data.room_price);
			$("#room_status").val(parsed_data.room_status);
			
			$("#admin_add_room_div").dialog({
		 		show: {effect: "slide", direction: "up"},
				hide: {effect: "slide", direction: "up"},
		 		modal: true,
		 		draggable: false,
	 			resizable: false,
		 		width: 600,
		 		height: 350,
		 		buttons: {
		 			"SAVE": function() {
		 				var integer_pattern = /^[0-9]*$/;
		 				var room_number = $("#room_number").val();
		 				var floor_number = $("#floor_number").val();
		 				var room_price = $("#room_price").val();
		 				var room_number_valid = integer_pattern.test(room_number);
		 				var floor_number_valid = integer_pattern.test(floor_number);
		 				var room_price_valid = integer_pattern.test(room_price);
		 				if(room_number != "" && room_number_valid && floor_number != "" && floor_number_valid && room_price != "" && room_price_valid) {
			 				$.ajax({
			 					type: "POST",
			 					url: "PHP/ADMINISTRATOR'S/edit_room.php",
			 					data: {"room_data": JSON.stringify($("#admin_room_form").serializeArray()), "id": $("#id").val()},
			 					success: function(data) {
			 						display_all_rooms();
			 						$("#admin_add_room_div").dialog("close");
			 					},
			 					error: function(data) {
			 						console.log("error in adding room = " + JSON.stringify(data));
			 					}
			 				});
			 			} else {
			 				$("#invalid_room_data_warning").show();
		 					$("#invalid_room_data_warning").fadeOut(6000);
			 			}
		 			},
		 			"CANCEL": function() {
		 				$("#admin_add_room_div").dialog("close");
		 			}
		 		}
	 		});
		},
		error: function(data) {
			console.log("error in retrieving room data = " + JSON.stringify(data));
		}
	});
}

function delete_room(id) {
	$("#delete_room_confirmation").dialog({
		show: {effect: "slide", direction: "up"},
		hide: {effect: "slide", direction: "up"},
 		modal: true,
 		draggable: false,
		resizable: false,
 		width: 500,
 		buttons: {
 			"YES": function() {
 				$.ajax({
					type: "POST",
					url: "PHP/ADMINISTRATOR'S/delete_room.php",
					data: {"id": id},
					success: function() {
						$("#room_" + id).remove();
						$("#delete_room_confirmation").dialog("close");
					},
					error: function(data) {
						console.log("error in deleting room = " + JSON.stringify(data));
					}
				});
 			},
 			"NO": function() {
 				$("#delete_room_confirmation").dialog("close");
 			}
 		}
	});
	
}

function display_attendants() {
	$.ajax({
		url: "PHP/ADMINISTRATOR'S/display_attendants.php",
		success: function(data) {
			$("#admin_attendants_table").html(data);
		},
		error: function(data) {
			console.log("error in displaying attendants = " + JSON.stringify(data));
		}
	});
}

function get_current_time() {
	var time = new Date();
	var hour = time.getHours();
	var minute = time.getMinutes();
	var extension = "AM";
	var month = time.getMonth();
	var date = time.getDate();
	var year = time.getFullYear();
	
	if(hour > 12) {
		hour = hour - 12;
		extension = "PM";
	}
	
	if(hour == 0) {
		hour = 12;
	}
	
	if(minute < 10) {
		minute = "0" + minute;
	}
	
	var month_array = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var month_counter = 0;
	
	while(month_counter <= month_array.length) {
		if(month_counter == month) {
			month = month_array[month_counter];
		}
		month_counter++;
	}
	
	$("#current_time").val(month + " " + date + ", " + year + " " + hour + ":" + minute + " " + extension);
	
	setTimeout(get_current_time, 1000);
}
