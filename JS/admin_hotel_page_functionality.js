$(document).ready(function() {
		
	//----------- ADMINISTRATOR'S PAGE ----------

	 $("#admin_navigator_tabs_div").tabs();
	 
	 // hidden ----
	 $("#admin_add_room_div").hide();
	 $("#add_attendant_div").hide();
	 $("#delete_attendant_div").hide();
	 $("#edit_attendant_div").hide();
	 $("#add_notes_div").hide();
	 $("#save_note_button").hide();
	 $("#delete_note_confirmation").hide();
	 $("#delete_room_confirmation").hide();
	 $("#remove_attendant_confirmation").hide();
	 
	 //warnigns ----
	 $(".warning").hide();
	 
	 $("#admin_cancel_button").click(function() {
	 	$("#admin_add_room_div").fadeOut(200);
	 });
	 
	 $("#close_note").click(function() {
		$("#add_notes_div").slideUp(1000);
	});
	
	$("#add_notes_button").click(function() {
		$("#add_notes_div").slideDown();
	})
	 
	 $("#admin_attendants_a").addClass('active_a');
	 
	 $("#admin_attendants_a").click(function() {
	    $(this).addClass('active_a');
	    $("#admin_all_rooms_a").removeClass('active_a');
	    $("#admin_notes_a").removeClass('active_a');
	 });
	 
	 $("#admin_all_rooms_a").click(function() {
	    $(this).addClass('active_a');
	    $("#admin_attendants_a").removeClass('active_a');
	    $("#admin_notes_a").removeClass('active_a');
	 });
	
	 $("#admin_notes_a").click(function() {
	    $(this).addClass('active_a');
	    $("#admin_attendants_a").removeClass('active_a');
	    $("#admin_all_rooms_a").removeClass('active_a');
	 });
	 
	 // --- GENDER -- //
	 
	 $("#attendant_gender").click(function() {
		$("#select_gender").hide();
	 });
	 
	 var month_array = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ];
	 var month_counter = 0;
	 while(month_counter < 12) {
	 	$("#attendant_birth_month").append("<option>" + month_array[month_counter] + "</option>");
	 	month_counter++;
	 }
	 var date_counter = 1;
	 while(date_counter <= 31) {
	 	$("#attendant_birth_date").append("<option>" + date_counter + "</option>");
	 	date_counter++;
	 }
	 var year_counter = 1995;
	 while(year_counter > 1950) {
	 	$("#attendant_birth_year").append("<option>" + year_counter + "</option>");
	 	year_counter--;
	 }
	
})
