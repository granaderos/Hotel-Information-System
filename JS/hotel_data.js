$(document).ready(function(){

	determine_current_user();
	display_rooms();
	get_current_time();
	display_current_record();
	display_checked_out_record();
	display_payment_record();
	display_notes();
	search_current_record();
	
	$("#search_current_record_firstname_field").keyup(function() {
		$.ajax({
			type: "POST",
			url: "PHP/HOTEL_DATA/search_current_record_firstname.php",
			data: {"search_current_record_firstname_field": $("#search_current_record_firstname_field").val()},
			success: function(data) {
				if(data != ""){
					$("#current_record_table").html(data);
				} else {
					$("#current_record_table").html("<tr><td> *** NO DATA *** </td></tr>");
				}
				
				if($("#current_record_search_field").val() == "") {
					display_current_record();
				}
			},
			error: function(data) {
				console.log("error in searching current record = " + JSON.stringify(data));
			}
		});
	});
	
	$("#search_current_record_lastname_field").keyup(function() {
		$.ajax({
			type: "POST",
			url: "PHP/HOTEL_DATA/search_current_record_lastname.php",
			data: {"search_current_record_lastname_field": $("#search_current_record_lastname_field").val()},
			success: function(data) {
				if(data != ""){
					$("#current_record_table").html(data);
				} else {
					$("#current_record_table").html("<tr><td> *** NO DATA *** </td></tr>");
				}
				
				if($("#current_record_search_field").val() == "") {
					display_current_record();
				}
			},
			error: function(data) {
				console.log("error in searching current record using last name = " + JSON.stringify(data));
			}
		});
	});
	
	$("#check_out_record_search_field").keyup(function() {
		$.ajax({
			type: "POST",
			url: "PHP/HOTEL_DATA/search_check_out_record.php",
			data: {"name_entered": $("#check_out_record_search_field").val() },
			success: function(data) {
				if(data != ""){
					$("#check_out_record_table").html(data);
				} else {
					$("#check_out_record_table").html("<tr><td> *** NO DATA *** </td></tr>");
				}
				
				if($("#check_out_record_search_field").val() == "") {
					display_checked_out_record();
				}
			},
			error: function(data) {
				console.log("error in searching payment record = " + JSON.stringify(data));
			}
		});
	});
	
	$("#payment_record_search_field").keyup(function() {
		$.ajax({
			type: "POST",
			url: "PHP/HOTEL_DATA/search_payment_record.php",
			data: {"payment_record_search_field": $("#payment_record_search_field").val()},
			success: function(data) {
				if(data != ""){
					$("#payment_record_table").html(data);
				} else {
					$("#payment_record_table").html("<tr><td> *** NO DATA *** </td></tr>");
				}
				
				if($("#payment_record_search_field").val() == "") {
					display_payment_record();
				}
			},
			error: function(data) {
				console.log("error in searching current record using last name = " + JSON.stringify(data));
			}
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
		if($("#note_about").val() != "" && $("#note_description").val() != "") {
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
        } else {
            $("#note_warning").show();
            $("#note_warning").fadeOut(7000);
        }

	});
	
	$("#sort_current_record_by").change(function() {
		display_current_record();
	});
	
	$("#sort_checked_out_record_by").change(function() {
		display_checked_out_record();
	});
	
	// ````````````	PAYMENT		```````````` 
	
	$("#amount_given").keyup(function() {
		var integer_pattern = /^[0-9]*$/;
		
		var amount_given = $("#amount_given").val();
		var amount_to_pay = $("#amount_to_pay").val();
		var amount_change = amount_given - amount_to_pay;
		
		var amount_given_valid = integer_pattern.test(amount_given);
		
		if(!amount_given_valid) {
			$("#amount_change").val("");
			$("#invalid_amount_given_warning").show();
		} else {
			$("#invalid_amount_given_warning").hide();
		}
		
		if(amount_change < 0) {
			$("#deficient_amount").show();
			$("#amount_change").val("");
		} else {
			$("#amount_change").val(amount_change);
			$("#deficient_amount").hide();
		}

	});
	
	$("#payment_record_select_month").change(function() {
		display_payment_record();
	});
	
	$("#payment_record_select_year").change(function() {
		display_payment_record();
	});
	
	//`````````````` SETTING PAYMENT RECORD FORM ``````````
	
	var date = $("#current_date").val();
	var month = $("#current_month").val();
	var year = $("#current_year").val();
	
	$("#payment_record_select_date").val(date);
	$("#current_date_viewed_payment_record_span").html(date);
	$("#payment_record_select_month").val(month);
	$("#payment_record_select_yeat").val(year);
	
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

function display_rooms() {
	$.ajax({
		url: "PHP/HOTEL_DATA/display_rooms.php",
 		success: function(data) {
 			$("#rooms_data_div").html(data);
 			if(data == "") {
				$("#rooms_data_div").html("<tr><td>NO DATA</td></tr>");
			}
 		},
		error: function(data) {
			console.log("error in displaying rooms data = " + JSON.stringify(data));
		}
	});
	
	setTimeout(display_rooms, 1000);
}

function display_current_record() {
	$.ajax({
		type: "POST",
		data: {"sort_current_record_by": $("#sort_current_record_by").val()},
		url: "PHP/HOTEL_DATA/display_current_record.php",
		success: function(data) {
			$("#current_record_table").html(data);
			if(data == "") {
				$("#current_record_table").html("<tr><td>NO DATA</td></tr>");
			}
		},
		error: function(data) {
			consoe.log("error in displaying current record = " + JSON.stringify(data));
		}
	});
}

function occupy_room(id) {
    var room_number = 0;
    var room_price = 0;

	$.ajax({
		type: "POST",
		url: "PHP/HOTEL_DATA/retrieve_room_number_to_occupy.php",
		data: {"id": id},
		success: function(data) {
            var parsed_data = JSON.parse(data);
			room_number = parsed_data.room_number;
			room_price = parsed_data.room_price;
			$("#room_number_to_occupy_span").html(data);
			$("#amount_to_pay").val(room_price);
		},
		error: function(data) {
			console.log("error in retrieving room number to ocupy = " + JSON.stringify(data));
		}
	}).done(function() {
            $("#option_div").dialog({
                title: "ROOM " + room_number,
                show: {effect: "slide", direction: "up"},
                hide: {effect: "slide", direction: "up"},
                width: 400,
                modal: true,
                buttons: {
                    "OCCUPY": function() {
                        $("#option_div").dialog("close");
                        $("#amount_to_pay").val(room_price);

                        // calculates amount_to_pay according to date of check out entered //

                        $("#date_of_check_out").change(function() {
                            var date_of_check_out = $("#date_of_check_out").val();
                            if(date_of_check_out != "") {
                                $.ajax({
                                    type: "POST",
                                    url: "PHP/HOTEL_DATA/get_total_days_of_stay_base_on_entered_date_of_check_out.php",
                                    data: {"date_of_check_out": date_of_check_out, "id": $("#id").val()},
                                    success: function(data) {
                                        var total_amount_to_pay = room_price * data;
                                        $("#amount_to_pay").val(total_amount_to_pay);
                                    },
                                    error: function(data) {
                                        console.log("error in getting days of stay = " + JSON.stringify(data));
                                    }
                                });
                            }
                        });

                        $("#check_in_div_content").dialog({
                            show: {effect: "slide", direction: "up"},
                            hide: {effect: "slide", direction: "up"},
                            title: "OCCUPY ROOM ***** " + room_number + " *****",
                            modal: true,
                            resizable: false,
                            draggable: false,
                            width: 800,
                            buttons: {
                                "CHECK IN": function() {
                                    var string_pattern = /^[a-z, A-Z, -]*$/;
                                    var integer_pattern = /^[0-9]*$/;

                                    var firstname = $("#firstname").val();
                                    var lastname = $("#lastname").val();
                                    var age = $("#age").val();
                                    var contact_number = $("#contact_number").val();
                                    var address = $("#address").val();

                                    var firstname_valid = string_pattern.test(firstname);
                                    var lastname_valid = string_pattern.test(lastname);
                                    var age_valid = integer_pattern.test(age);
                                    var contact_number_valid = integer_pattern.test(contact_number);

                                    if(firstname != "" && firstname_valid && lastname != "" && lastname_valid && age != "" && age_valid && contact_number != "" && contact_number_valid && contact_number.length == 11 && address != "") {
                                        if($("#gender").val() != "--select gender--"){
                                            $.ajax({
                                                type: "POST",
                                                url: "PHP/HOTEL_DATA/add_check_in.php",
                                                data: {"data": JSON.stringify($("#customer_form_id").serializeArray()), "payment_data": JSON.stringify($("#payment_form").serializeArray()), "id": id},
                                                success: function(data) {
                                                    $("#check_in_div_content").dialog("close");
                                                    display_current_record();
                                                    display_rooms();
                                                    $("#pay_now_button").show();
                                                    $("#payment_table").hide();

                                                },
                                                error: function(data) {
                                                    consoe.log("error in adding check in :P = " + JSON.stringify(data));
                                                }
                                            });
                                        } else{
                                            $("#invalid_customer_gender").show();
                                            $("#invalid_customer_gender").fadeOut(8000);
                                        }
                                    } else {
                                        $("#invalid_customer_data").show();
                                        $("#invalid_customer_data").fadeOut(8000);
                                    }
                                },
                                "CANCEL": function() {
                                    $("#pay_now_button").show();
                                    $("#payment_table").hide();
                                    $(this).dialog("close");
                                }
                            }

                        });

                    },
                    "RESERVE": function() {
                        $(this).dialog("close");
                        $("#reserve_room_div").dialog({
                            show: {effect: "slide", direction: "up"},
                            hide: {effect: "slide", direction: "up"},
                            modal: true,
                            resizable: false,
                            draggable: false,
                            buttons: {
                                "SAVE": function() {
                                    var name_pattern = /^[a-z, A-Z, -]*$/;
                                    var firstname = $("#reserve_to_firstname").val();
                                    var lastname = $("#reserve_to_lastname").val();
                                    var firstname_valid = name_pattern.test(firstname);
                                    var lastname_valid = name_pattern.test(lastname);
                                    if(firstname != "" && firstname_valid && lastname != "" && lastname_valid) {
                                        $(this).dialog("close");
                                        $.ajax({
                                            type: "POST",
                                            url: "PHP/HOTEL_DATA/add_reservation.php",
                                            data: {"id": id, "reserve_to_firstname": $("#reserve_to_firstname").val(), "reserve_to_lastname": $("#reserve_to_lastname").val()},
                                            success: function(data) {
                                                display_rooms();
                                            },
                                            error: function(data) {
                                                console.log("error in reserving rooms = " + JSON.stringify(data));
                                            }
                                        });
                                    } else {
                                        $("#invalid_customer_name_to_reserve").show();
                                        $("#invalid_customer_name_to_reserve").fadeOut(8000);
                                    }
                                },
                                "CANCEL": function() {
                                    $("#reserve_room_div").dialog("close");
                                }
                            }
                        });
                        $("#reserve_room_div").dialog("option", "title", "RESERVE ROOM " + room_number);
                    },
                    "CANCEL": function() {
                        $(this).dialog("close");
                    }
                }
            });
        }); // .done function ends
}

function occupy_reserved_room(id) {
	$.ajax({
		type: "POST",
		url: "PHP/HOTEL_DATA/retrieve_reserved_data.php",
		data: {"id": id},
		success: function(data) {
			var parsed_data = JSON.parse(data);
			$("#room_number_to_occupy_span").html(parsed_data.room_number);
			$("#reserve_to_span").html("This room is reserved to " + parsed_data.reserve_to_firstname + " " + parsed_data.reserve_to_lastname + ".");
			$("#firstname").val(parsed_data.reserve_to_firstname);
			$("#lastname").val(parsed_data.reserve_to_lastname);
			$("#check_in_div_content").dialog({
				title: "OCCUPY ROOM ***** " + parsed_data.room_number + " *****",
				show: {effect: "slide", direction: "up"},
				hide: {effect: "slide", direction: "up"},
				width: 800,
				modal: true,
				resizable: false,
				draggable: false,
				buttons: {
					"CHECK IN": function() {
						var string_pattern = /^[a-z, A-Z, -]*$/;
						var integer_pattern = /^[0-9]*$/;
						
						var firstname = $("#firstname").val();
						var lastname = $("#lastname").val();
						var age = $("#age").val();
						var contact_number = $("#contact_number").val();
						var address = $("#address").val();
						var amount_given = $("#amount_given").val();
						var amount_to_pay = $("#amount_to_pay").val();
						
						var firstname_valid = string_pattern.test(firstname);
						var lastname_valid = string_pattern.test(lastname);
						var age_valid = integer_pattern.test(age);
						var contact_number_valid = integer_pattern.test(contact_number);
						var amount_given_valid = integer_pattern.test(amount_given);
						
						if(firstname != "" && firstname_valid && lastname != "" && lastname_valid && age != "" && age_valid && contact_number != "" && contact_number_valid && contact_number.length == 11 && address != "") {
							if($("#gender").val() != "--select gender--"){
								$.ajax({
									type: "POST",
									url: "PHP/HOTEL_DATA/add_check_in.php",
									data: {"data": JSON.stringify($("#customer_form_id").serializeArray()), "current_time": $("#current_time").val(), "payment_data": JSON.stringify($("#payment_form").serializeArray()), "id": id, "current_month": $("#current_month").val(), "current_date": $("#current_date").val(), "current_year": $("#current_year").val()},
									success: function(data) {
										$("#current_record_table").append(data);
										display_rooms();
										$("#check_in_div_content").dialog("close");
									},
									error: function(data) {
										consoe.log("error in adding check in :P = " + JSON.stringify(data));
									}
								});
							} else{
								$("#invalid_customer_gender").show();
								$("#invalid_customer_gender").fadeOut(8000);
							}
						} else {
							$("#invalid_customer_data").show();
							$("#invalid_customer_data").fadeOut(7000);
						}
					}, // check in button function
					"CANCEL": function() {
						$("#check_in_div_content").dialog("close");
						$("#pay_now_button").show();
					} // cancel button function end bracket 
				} //buttons of check in div dialog end bracket
			}); // check in div dialog end
		
		},
		error: function(data) {
			console.log("error in retrieving reserved data = " + JSON.stringify(data));
		}
	});
}

function check_out_customer(id) {
    var room_price;
    $("#read_only_date_of_check_out").val($("#current_time").val());
    alert($("#current_time").val());
	$("#check_out_confirmation").dialog({
		show: {effect: "slide", direction: "up"},
		hide: {effect: "slide", direction: "up"},
		modal: true,
		resizable: false,
		draggable: false,
		buttons: {
			"YES": function() {
				$.ajax({
					type: "POST",
					url: "PHP/HOTEL_DATA/check_customer_payment.php",
					data: {"id": id},
					success: function(data) {
						if(data == "customer was already paid") {
							$.ajax({
								type: "POST",
								url: "PHP/HOTEL_DATA/check_out_customer.php",
								data: {"id": id, "current_time": $("#current_time").val()},
								success: function() {
									display_checked_out_record();
									$(document.getElementById(id)).remove();
									$("#check_out_confirmation").dialog("close");
								},
								error: function(data) {
									console.log("error in checking out customer = " + JSON.stringify(data));
								}
							});
						} else {
                            room_price = data;
							$("#check_out_confirmation").dialog("close");
							$("#amount_to_pay").val(room_price);
                            $("#date_of_check_out_tr").hide();
                            $("#read_only_date_of_check_out_tr").show();
                            var current_time = $("#current_time").val();
                            $("#read_only_date_of_check_out").val(current_time);
                            //  COUMPUTES THE TOTAL AMOUNT TO PAY
                            var date_of_check_out = $("#read_only_date_of_check_out").val();
                            $.ajax({
                                type: "POST",
                                url: "PHP/HOTEL_DATA/get_total_days_of_stay_base_on_entered_date_of_check_out.php",
                                data: {" read_only_date_of_check_out": date_of_check_out, "id": id},
                                success: function(data) {
                                    alert("days of stay = " + data);
                                    var total_amount_to_pay = room_price * data;
                                    alert("total amount = " + total_amount_to_pay);
                                    $("#amount_to_pay").val(total_amount_to_pay);
                                },
                                error: function(data) {
                                    console.log("error in getting total days of stay = " + JSON.stringify(data));
                                }
                            });
							$("#payment_table").dialog({
								title: "PAYMENT",
								show: {effect: "slide", direction: "up"},
								hide: {effect: "slide", direction: "up"},
                                width: 500,
								modal: true,
								resizable: false,
								draggable: false,
								buttons: {
									"SUBMIT": function() {
										var integer_pattern = /^[0-9]*$/;
										var amount_given = $("#amount_given").val();
										var amount_to_pay = $("#amount_to_pay").val();
										var amount_change = amount_given - amount_to_pay;
										var amount_given_valid = integer_pattern.test(amount_given);
										if(amount_given != "" && amount_given_valid && !(amount_change < 0)) {
											$.ajax({
												type: "POST",
												url: "PHP/HOTEL_DATA/add_payment.php",
												data: {"id": id, "amount_given": amount_given, "amount_to_pay": amount_to_pay, "current_data": JSON.stringify($("#current_day_form").serializeArray())},
												success: function() {
													display_payment_record();
												},
												error: function(data) {
													console.log("error in adding in payment record = " + JSON.stringify(data));
												}
											});
									
											$.ajax({
												type: "POST",
												url: "PHP/HOTEL_DATA/check_out_customer.php",
												data: {"id": id, "current_time": $("#current_time").val()},
												success: function() {
													display_checked_out_record();
													$(document.getElementById(id)).remove();
													$("#check_out_confirmation").dialog("close");
                                                    $("#date_of_check_out_tr").show();
                                                    $("#read_only_date_of_check_out_tr").hide();
													$("#payment_table").dialog("close");
												},
												error: function(data) {
													console.log("error in checking out customer = " + JSON.stringify(data));
												}
											});
										} // if statement ends 
									},
                                    "CANCEL": function() {
                                        $(this).dialog("destroy");
                                        $("#date_of_check_out_tr").show();
                                        $("#read_only_date_of_check_out_tr").hide();
                                    }
								} // end of buttons
							});
						}
					},
					error: function(data) {
						console.log("error in checking customer's payment! = " + JSON.stringify(data));
					}
				});
			},
			"NO": function() {
				$("#check_out_confirmation").dialog("close");
			}
		}
	})
	
}

function display_checked_out_record() {
	$.ajax({
		type: "POST",
		url: "PHP/HOTEL_DATA/display_checked_out_record.php",
		data: {"sort_checked_out_record_by": $("#sort_checked_out_record_by").val()},
		success: function(data) {
			$("#check_out_record_table").html(data);
			if(data == "") {
				$("#check_out_record_table").html("<tr><td>EMPTY RECORD</td></tr>");
			}
		},
		error: function(data) {
			console.log("error in displaying checked out record = " + JSON.stringify(data));
		}
	});
}

function delete_check_out_record() {
	var id_to_delete = new Array();
	var checked_out_record_table = document.getElementById("check_out_record_table");
	var rows = checked_out_record_table.getElementsByTagName("tr");

	var counter = 1;

	while(counter < rows.length) {
		var tr_id = document.getElementById(rows[counter].id);
		var checkbox = document.getElementById('out_' + tr_id.id);
		if(checkbox.checked) {
			id_to_delete.push(tr_id.id);
		}
		counter++;
	}
	
	if(id_to_delete == "") {
		alert("Nothing to delete!");
	} else {
		$("#delete_checked_out_record_confirmation").dialog({
			message: "WAHAHAHAHA",
			show: {effect: "slide", direction: "up"},
			hide: {effect: "slide", direction: "up"},
			modal: true,
			resizable: false,
			draggable: false,
			caption: "GGGGRRRRRr",
			buttons: {
				"CONTINUE": function() {
					$.ajax({
						type: "POST",
						url: "PHP/HOTEL_DATA/delete_checked_out_record.php",
						data: {"id": id_to_delete},
						success: function() {
							for(var id_counter = 0; id_counter < id_to_delete.length; id_counter++) {
								$("#check_out_record_table").find($("#" + id_to_delete[id_counter])).remove();
							}
							$("#delete_checked_out_record_confirmation").dialog("close");
						},
						error: function(data) {
							console.log("error in deleting checked out record = " + JSON.stringify(data));
						}
					});
				},
				"CANCEL": function() {
					$("#delete_checked_out_record_confirmation").dialog("close");
				}
			}
		});
	}
}

function display_payment_record() {
	$.ajax({
		type: "POST",
		url: "PHP/HOTEL_DATA/display_payment_record.php",
		data: {"data": JSON.stringify($("#payment_record_select_form").serializeArray())},
		success: function(data) {
			$("#payment_record_table").html(data);
			get_daily_total_payment();
			if(data == "") {
					$("#payment_record_table").html("<tr><td>NO RECORD</td></tr>");
			}
		},
		error: function(data) {
			consoe.log("error in displaying payment record = " + JSON.stringify(data));
		}
	});
	
	setTimeout(display_payment_record, 1000);
}

function view_previous_payment_record() {
	var last_viewed_date = parseInt($("#payment_record_select_date").val());
	var date_to_view = last_viewed_date - 1;
	if(date_to_view != 0) {
		$("#payment_record_select_date").val(date_to_view);
		$("#current_date_viewed_payment_record_span").html(date_to_view);
		display_payment_record();
		get_daily_total_payment();
	}
	
}

function view_next_payment_record() {
	var last_viewed_date = parseInt($("#payment_record_select_date").val());
	var date_to_view = last_viewed_date + 1;
	var month_to_view = $("#payment_record_select_month").val();
	var current_date = $("#current_date").val();
	var current_month = $("#current_month").val();
	
	if(month_to_view == current_month && date_to_view > current_date) {
		return false;
	} else {
		if(month_to_view == 'February' && date_to_view > 29) {
			$("#payment_record_select_date").val("29"); 
		} else {
			if(month_to_view == 'February' && date_to_view <= 29) {
				$("#payment_record_select_date").val(date_to_view);
				$("#current_date_viewed_payment_record_span").html(date_to_view);
				display_payment_record();
				get_daily_total_payment();
			}
		}
		if(month_to_view == "January" || month_to_view == "March" || month_to_view == "May" || month_to_view == "July" || month_to_view == "August" || month_to_view == "October" || month_to_view == "December") {
			if(date_to_view <= 31) {
				$("#payment_record_select_date").val(date_to_view);
				$("#current_date_viewed_payment_record_span").html(date_to_view);
				display_payment_record();
				get_daily_total_payment();
			}
	
		}
		if(month_to_view == "April" || month_to_view == "June" || month_to_view == "September" || month_to_view == "November") {
            if(date_to_view <= 30) {
                $("#payment_record_select_date").val(date_to_view);
                $("#current_date_viewed_payment_record_span").html(date_to_view);
                display_payment_record();
                get_daily_total_payment();
            }
		}
	}
}

function get_daily_total_payment() {
	$.ajax({
		type: "POST",
		url: "PHP/HOTEL_DATA/get_daily_total_payment.php",
		data: {"data": JSON.stringify($("#payment_record_select_form").serializeArray())},
		success: function(data) {
			$("#payment_record_daily_total").html(data);
		},
		error: function(data) {
			console.log("error in getting daily total payment = " + JSON.stringfy(data));
		}
	});
}

function search_current_record() {
	if($("#search_current_record_firstname_field").val() != "" && $("#search_current_record_lastname_field").val() != "") {
		$.ajax({
			type: "POST",
			url: "PHP/HOTEL_DATA/search_current_record.php",
			data: {"firstname": $("#search_current_record_firstname_field").val(), "lastname": $("#search_current_record_lastname_field").val()},
			success: function(data) {
				if(data != ""){
					$("#current_record_table").html(data);
				} else {
					$("#current_record_table").html("<tr><td> *** NO DATA *** </td></tr>");
				}
				
				if($("#current_record_search_field").val() == "") {
					display_current_record();
				}
			},
			error: function(data) {
				console.log("error in searching current record = " + JSON.stringify(data));
			}
		});
		setTimeout(search_current_record, 1000);
	}
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
		show: {effect: "slide", direction: "up"},
		hide: {effect: "slide", direction: "up"},
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

function get_current_time() {
	var time = new Date();
	var hour = time.getHours();
	var minute = time.getMinutes();
    var second = time.getSeconds();
	var extension = "AM";
	var month = time.getMonth() + 1;
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

    if(second < 10) {
        second = "0" + second;
    }
	
	if(date < 10) {
		date = "0" + date;
	}

    if(month < 10) {
        month = "0" + month;
    }

	$("#current_time").val(year + "-" + month  + "-" + date + " " + hour  + ":" + minute + ":" + second);
    $("#read_only_date_of_check_out").val(year + "-" + month  + "-" + date + " " + hour  + ":" + minute + ":" + second);
	$("#current_date").val(date);
	$("#current_year").val(year);

    var month_array = ["index zero. this is futile!", "January", "February", "March", "April", "May", "Jlllune", "July", "August", "September", "October", "November", "December"];
    var month_counter = 1;

    while(month_counter < month_array.length) {
        if(month_counter == month) {
            month = month_array[month_counter];
        }
        month_counter++;
    }
    $("#current_month").val(month);
	
	setTimeout(get_current_time, 1000);
}
