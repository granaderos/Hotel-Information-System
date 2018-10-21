$(document).ready(function(){
	$("#navigator_tabs_div").tabs();
	$("#calendar_div").datepicker();
    $("#date_of_check_out").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        minDate: '+0d'
    });
    $("#date_of_check_out").datepicker("option", "dateFormat", 'yy-mm-dd');

	$("#home_a").addClass("active_a");
	
	$(".warning").hide();
	$("#save_note_button").hide();
	$("#amount_change_div").hide();
	$("#payment_table").hide();
	$(".checkbox_for_checked_out_record_td").hide();
	$(".checkbox_for_payment_record_td").hide();
	$("#check_out_hide_action_button").hide();
	$("#th_delete_payment_record_button_container").hide();
	$("#invalid_input_field_value_warning").hide();
    $("#read_only_date_of_check_out_tr").hide();
	
	//hidden divs for dialogs //
	
	$("#option_div").hide(); 
	$("#reserve_room_div").hide();
	$("#add_notes_div").hide();
	$("#delete_note_confirmation").hide();
	$("#note_warning").hide();
	$("#calendar_div").hide();
	$("#check_in_div_content").hide();
	$("#check_out_confirmation").hide();
	$("#delete_checked_out_record_confirmation").hide();
	$("#mark_unmark_option_span").hide();
	$("#calculator_div").hide();
	
	$("#check_out_show_action_button").click(function() {
		$("#thead_row").append("<th id = 'th_delete_checked_out_record_button_container'><button id = 'delete_checked_out_record_button' onclick = 'delete_check_out_record()'>delete</button></th>");
		$(this).hide();
		$("#mark_unmark_option_span").show();
		$(".checkbox_td").css("visibility", "visible");
		$("#check_out_hide_action_button").show();
		$("#a_options").show();
		
		$("#mark_all_span").click(function() {
			$("#check_out_record_table").find(".check_wew").attr('checked', true);
		});
		$("#unmarked_all_span").click(function() {
			$("#check_out_record_table").find(".check_wew").attr('checked', false);
		});
		
		$("#check_out_record_table").find("tr").click(function() {
			if($(this).find("input").attr('checked')) {
				$(this).find("input").attr('checked', false);
			}  else {
				$(this).find("input").attr('checked', true);
			}
		});
		
		$(".check_wew").click(function() {
			if($(this).attr('checked')) {
				$(this).attr('checked', false);
			}  else {
				$(this).attr('checked', true);
			}
		});
		
	});
	
	$("#check_out_hide_action_button").click(function() {
		$("#th_delete_checked_out_record_button_container").remove();
		$(this).hide();
		$(".checkbox_td").css("visibility", "hidden");
		$("#mark_unmark_option_span").hide();
		
		$("#check_out_show_action_button").show();
		$("#a_options").hide();
	});
	
	
	$("#pay_now_button").click(function() {
		$("#payment_table").slideDown(4000);
		$(this).hide();
		
		$("#pay_later_button").click(function() {
			$("#pay_now_button").show();
			$("#payment_table").slideUp();
		});
	});

	$("#calendar_a").click(function() {
		$("#calendar_div").dialog({
			title: " CALENDAR ",
			show: {effect: "slide", direction: "up"},
			hide: {effect: "slide", direction: "up"},
			width: 290,
			buttons: {
				"CLOSE": function() {
					$(this).dialog("close");
				}
			}
		});
	});
	
	$("#calculator_a").click(function() {
		$("#calculator_div").dialog({
			title: " CALCULATOR ",
			show: {effect: "slide", direction: "up"},
			hide: {effect: "slide", direction: "up"},
			width: 250,
			buttons: {
				"CLOSE": function() {
					$(this).dialog("close");
				}
			}
		});
	});
	
	$("#close_note").click(function() {
		$("#add_notes_div").slideUp(1000);
		$("#save_note_button").hide();
		$("#post_note_button").show();
		$("#note_about").val("");
		$("#note_description").val("");
	});
	
	$("#add_notes_button").click(function() {
		$("#add_notes_div").slideDown();
	})
	
	$("#close_check_in_button").click(function(){
		$("#reserve_to_span").html("");
		$("#firstname").val("");
		$("#lastname").val("");
		$("#check_in_div_container").hide();
	});
	
	$("#home_a").click(function() {
		$("#home_a").addClass("active_a");
		$("#rooms_a").removeClass("active_a");
		$("#current_record_a").removeClass("active_a");
		$("#check_out_record_a").removeClass("active_a");
		$("#payment_record_a").removeClass("active_a");
		$("#notes_a").removeClass("active_a");
	});
	
	$("#rooms_a").click(function() {
		$("#rooms_a").addClass("active_a");
		$("#home_a").removeClass("active_a");
		$("#current_record_a").removeClass("active_a");
		$("#check_out_record_a").removeClass("active_a");
		$("#payment_record_a").removeClass("active_a");
		$("#notes_a").removeClass("active_a");
	});
	
	$("#current_record_a").click(function() {
		$("#current_record_a").addClass("active_a");
		$("#home_a").removeClass("active_a");
		$("#rooms_a").removeClass("active_a");
		$("#check_out_record_a").removeClass("active_a");
		$("#payment_record_a").removeClass("active_a");
		$("#notes_a").removeClass("active_a");
	});
	
	$("#check_out_record_a").click(function() {
		$("#check_out_record_a").addClass("active_a");
		$("#home_a").removeClass("active_a");
		$("#rooms_a").removeClass("active_a");
		$("#current_record_a").removeClass("active_a");
		$("#payment_record_a").removeClass("active_a");
		$("#notes_a").removeClass("active_a");
	});
	
	$("#payment_record_a").click(function() {
		$("#payment_record_a").addClass("active_a");
		$("#home_a").removeClass("active_a");
		$("#rooms_a").removeClass("active_a");
		$("#current_record_a").removeClass("active_a");
		$("#check_out_record_a").removeClass("active_a");
		$("#notes_a").removeClass("active_a");
	});
	
	$("#notes_a").click(function() {
		$("#notes_a").addClass("active_a");
		$("#home_a").removeClass("active_a");
		$("#rooms_a").removeClass("active_a");
		$("#current_record_a").removeClass("active_a");
		$("#check_out_record_a").removeClass("active_a");
		$("#payment_record_a").removeClass("active_a");
	});
	
	//``````````` CALCULATOR FUNCTIONALITY `````````````
	
	var valid_calculator_input_value = /^[0-9, +, *, /, .]*$/;
	
	$("#calculator_input_field").keyup(function() {
		var expression = $("#calculator_input_field").val();
		var expression_valid = valid_calculator_input_value.test(expression);
		
		if(!expression_valid) {
			$("#invalid_input_field_value_warning").show();
		} else {
			$("#invalid_input_field_value_warning").hide();
		}
	});
	
	$("#button_1").click(function() {
		document.getElementById('calculator_input_field').value += '1';
	});
	
	$("#button_2").click(function() {
		document.getElementById('calculator_input_field').value += '2';
	});
	
	$("#button_3").click(function() {
		document.getElementById('calculator_input_field').value += '3';
	});
	
	$("#button_4").click(function() {
		document.getElementById('calculator_input_field').value += '4';
	});
	
	$("#button_5").click(function() {
		document.getElementById('calculator_input_field').value += '5';
	});
	
	$("#button_6").click(function() {
		document.getElementById('calculator_input_field').value += '6';
	});
	
	$("#button_7").click(function() {
		document.getElementById('calculator_input_field').value += '7';
	});
	
	$("#button_8").click(function() {
		document.getElementById('calculator_input_field').value += '8';
	});
	
	$("#button_9").click(function() {
		document.getElementById('calculator_input_field').value += '9';
	});
	
	$("#button_0").click(function() {
		document.getElementById('calculator_input_field').value += '0';
	});
	
	$("#button_add").click(function() {
		document.getElementById('calculator_input_field').value += '+';
	});
	
	$("#button_subtract").click(function() {
		document.getElementById('calculator_input_field').value += '-';
	});
	
	$("#button_multiply").click(function() {
		document.getElementById('calculator_input_field').value += '*';
	});
	
	$("#button_divide").click(function() {
		document.getElementById('calculator_input_field').value += '/';
	});
	
	$("#button_equals").click(function() {
		var answer = eval($("#calculator_input_field").val());
		$("#calculator_input_field").val(answer);
	});
	
	$("#td_clear").click(function() {
		$("#calculator_input_field").val("");
	});
	
	$("#calculator_form").submit(function() {
		
		var answer = eval($("#calculator_input_field").val());
		$("#calculator_input_field").val(answer);
		return false;
	});
	
	//``````````` APPENDING OPTION IN SELECT SELECT TAGS [= PAYMENT RECORD =] ``````````
	
	var month_array = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ];
	var month_counter = 0;
	while(month_counter < 12) {
	$("#payment_record_select_month").append("<option>" + month_array[month_counter] + "</option>");
	month_counter++;
	}
	
	var time = new Date;
	var current_year = time.getFullYear();
	var year_counter = 2013;
	while(year_counter <= current_year) {
	$("#payment_record_select_year").append("<option>" + year_counter + "</option>");
	year_counter++;
	}
	
	//``````````` SLIDING IMAGES `````````````````````````
	
	var slideimages = new Array();

	function slide_show_hotel_images() {

		  for (i = 0; i < slide_show_hotel_images.arguments.length; i++){
				slideimages[i] = new Image();
				slideimages[i].src = slide_show_hotel_images.arguments[i];
		 }
	}
	slide_show_hotel_images("CSS/images/hotel1.jpg","CSS/images/hotel2.jpg","CSS/images/hotel3.jpg", "CSS/images/hotel4.jpg", "CSS/images/hotel5.jpg");

	var image_number = 0;

	function show_image() {
	 	if (!document.images) 
	  		return 
	  		document.images.temporary_image.src = slideimages[image_number].src
	  
	  	if (image_number < slideimages.length-1) 
			image_number++;
	  	else 
			image_number = 0;
		setTimeout(show_image, 2000);
		
	}
	show_image();
	
});



