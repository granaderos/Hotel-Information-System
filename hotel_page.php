<?php
	session_start();

	if(!isset($_SESSION["username_entered"])) {
		header("Location: hotel_log_in_page.php");
	}
?>

<!Doctype html>
<html>
   <head>
       <title>attendant | hotel</title>
       <link rel = "stylesheet" href = "CSS/jquery-ui.min.css" />
       <link rel = "stylesheet" href = "CSS/hotel_page.css" />
       <link rel = "shortcut icon" href = "CSS/images/t.jpeg" />
   </head>
   <body>
   	<div id = "main_container_div">
      	<h1>MILKA HOTEL [Customer Management]</h1> <span id = "attendant_span">Attendant: </span><br />
      	
      	<div id = "navigator_tabs_div">
      		<ul id = "navigator_ul">
      			<li><a href = "#home_div" id = "home_a">HOME</a></li>
      			<li><a href = "#rooms_div" id = "rooms_a">ROOMS</a></li>
      			<li><a href = "#current_record_div" id = "current_record_a">CURRENT RECORD</a></li>
		   		<li><a href = "#check_out_record_div" id = "check_out_record_a">CHECKED-OUT RECORD</a></li>
				   <li><a href = "#payment_record_div" id = "payment_record_a">PAYMENT RECORD</a></li>
				   <li><a href = "#notes_div" id = "notes_a">NOTES</a></li>
				   <a href = "hotel_log_out.php" id = "log_out_a">SIGN OUT</a>
		   	</ul>
		   	
		   	<div id = "home_div">
		   		<div id = "first_page_float_right_div">
		   			<ul id = "home_menu_ul">
		   				<li><a id = "calendar_a">calendar</a></li>
		   				<li><a id = "calculator_a">calculator</a></li>
		   				<li><a id = "sites_a">sites</a>
		   					<ul id = "sites_ul" >
									<li><a href = "http://www.hotels.com/" id = "hotel_a">HOTELS</a></li>
									<li><a href = "http://www.google.com.ph/" id = "google_a">GOOGLE</a></li>
									<li><a href = "http://ph.yahoo.com/?p=us" id = "yahoo_a">YAHOO</a></li>
									<li><a href = "http://www.facebook.com/" id = "facebook_a">FACEBOOK</a></li>
									<li><a href = "https://twitter.com/" id = "twitter_a">TWITTER</a></li>
								</ul>
		   				</li>
		   				<li><a id = "program_documentation_a">documentation</a></li>
		   			</ul><!-- home menu ul ends-->

		   			<div id = "calendar_div"></div>
		   			<div id = "calculator_div">
		   				<?php include "PHP/calculator.php"; ?>
		   			</div><!-- calculator div ends -->
						<div id = "hotel_images_div">
							<img src = "CSS/images/t.jpeg" alt="Hotel images" name = "temporary_image" >
						</div>
					</div><!-- first page float right div-->
		   		<p id = "about_hotel_p">A hotel is an establishment that provides lodging paid on a short-term basis. The provision of basic accommodation, in times past, consisting only of a room with a bed, a cupboard, a small table and a washstand has largely been replaced by rooms with modern facilities, including en-suite bathrooms and air conditioning or climate control. Additional common features found in hotel rooms are a telephone, an alarm clock, a television, a safe, a mini-bar with snack foods and drinks, and facilities for making tea and coffee. Luxury features include bathrobes and slippers, a pillow menu, twin-sink vanities, and jacuzzi bathtubs. Larger hotels may provide additional guest facilities such as a swimming pool, fitness center, business center, childcare, conference facilities and social function services.
Hotel rooms are usually numbered (or named in some smaller hotels and B&Bs) to allow guests to identify their room. Some hotels offer meals as part of a room and board arrangement. In the United Kingdom, a hotel is required by law to serve food and drinks to all guests within certain stated hours. In Japan, capsule hotels provide a minimized amount of room space and shared facilities.</p>
		   	</div><!-- home page div ends! -->
		   	
		   	<div id = "rooms_div">
		     		<div id = "room_legend_div">
		     			<table id = "room_legend_table">
		     				<caption id = "room_legend_caption">LEGEND</caption>
		     				<tr>
		     					<th>AVAILABLE</th>
                                <th>OCCUPIED</th>
                                <th>RESERVED</th>
                                <th>OUT OF ORDER</th>
		     				</tr>
		     				<tr>
		     					<td id = "available_td"></td>
                                <td id = "occupied_td"></td>
                                <td id = "reserved_td"></td>
                                <td id = "out_of_order_td"></td>
		     				</tr>
		     			</table>
                        <div id = "additional_actions_div">

                        </div><!-- ======== Additionl actions div ends ========== -->
		     			<div id = "option_div" ></div>
		     			<div id = "reserve_room_div">
		     				<p id = "reserve_room_p">Whom: <br /><input type = "text" id = "reserve_to_firstname" name = "reserve_to_firstname" placeholder = "firstname"><br />
		     					<input type = "text" id = "reserve_to_lastname" name = "reserve_to_lastname" placeholder = "lastname">
		     				</p>
		     				<p class = "warning" id = "invalid_customer_name_to_reserve">Please check customer's name! Thank you! :)</p>
		     			</div><!-- reserve room div ends -->
		     		</div><br /><hr /><br />

                    <div id = "rooms_data_div">
                    </div><!-- rooms data div ends -->

                    <div id = "room_price_div">
                        <span>
                            <dl>&raquo;Single bed room</dl>
                            <dd>&#8369;750.00/night</dd>
                        </span>
                        <span>
                            <dl>&raquo;Double bed room</dl>
                            <dd>&#8369;850.00/night</dd>
                        </span>
                        <span>
                            <dl>&raquo;Twin bed room</dl>
                            <dd>&#8369;950.00/night</dd>
                        </span>
                        <span>
                            <dl>&raquo;Family-size bed room</dl>
                            <dd>&#8369;1, 200.00/night</dd>
                        </span>
                    </div><!-- room price div -->

		     		<!-- CHECK IN DIV-->
		     		
		     		<div id = "check_in_div_content">
						<span id = "reserve_to_span"></span><br /><br />
			         <form id = "customer_form_id">
			            <legend>CUSTOMER'S INFORMATION FORM</legend>
			            <table>
			               <tr>
			                  <td>First name:</td> <td><input type = "text" name = "firstname" id = "firstname" /></td>
			                  <td>Last name: </td><td><input type = "text" name = "lastname" id = "lastname" /></td>
			               </tr>
			               <tr>
			                  <td>Gender:</td><td><select name = "gender" id = "gender" class = "select_tag">
			                  	<option>--select gender--</option><option>female</option><option>male</option></select>
			                  </td>
			                  <td>Age:</td><td><input type = "number" name = "age" id = "age" /></td>
			               </tr>
			               <tr>
			                  <td>Contact Number:</td> <td><input type = "text" name = "contact_number" id = "contact_number"></td>
			                  <td>Address: </td><td><input type = "text" name = "address" id = "address"/></td>
			               </tr>
			           	</table>
			        		<button type = "reset" id = "reset_form"><accr title = "clear all"><img src = "CSS/images/clear_all1.png" /></accr></button>
			         </form>
			         <form id = "payment_form">
					      <table id = "payment_table">
                                <tr id = "date_of_check_out_tr">
                                    <td>Date of check-out:</td>
                                    <td><input type = "date" name = "date_of_check_out" id = "date_of_check_out" /></td>
                                </tr>
                                <tr id = "read_only_date_of_check_out_tr">
                                    <td>Date of check-out:</td>
                                    <td><input type = "date" name = "read_only_date_of_check_out" id = "read_only_date_of_check_out"/></td>
                                </tr>
                                <tr>
                                    <td><span id = "deficient_amount" class = "warning">Deficient amount given!</span></td>
                                </tr>
                                <tr>
                                     <td>amount given:</td>
                                     <td>&#8369;<input class = "peso_field" type = "text" name = "amount_given" id = "amount_given" /></td><td class = "warning" id = "invalid_amount_given_warning"><img src = "CSS/images/warning.png" /></td>
                                </tr>
                                <tr>
                                     <td>amount to pay:</td>
                                     <td>&#8369;<input class = "peso_field" id = "amount_to_pay" name = "amount_to_pay" readonly/></td><td class = "warning" id = "invalid_amount_to_pay_warning"><img src = "CSS/images/warning.png" /></td>
                                    </tr>
                                    <tr>
                                        <td>CHANGE: </td>
                                        <td>&#8369;<input class = "peso_field" id = "amount_change" readonly/></td>
                                    </tr>
                                </table>
					      <input type = "button" id = "pay_now_button" value = "pay now" class = 'attendant_button'/><input type = "reset" id = "pay_later_button" value = "pay later" class = 'attendant_button'/>
			         </form>
			         <p class = "warning" id = "invalid_customer_data">Please check customer's info. Don't leave an empty field. Thank you!</p>
			         <p class = "warning" id = "invalid_customer_gender">Please select customer's gender!</p>
			   	</div><!-- check in div content ends -->
		     	</div><!-- rooms div ends -->
		   	
		   	<div id = "current_record_div">
		   		<form id = "current_record_search_form">
		   			<center>
		   			    <input type = "text" class = "search_field" id = "search_current_record_lastname_field" name = "search_current_record_lastname_field" placeholder = "SEARCH BY LAST NAME" /><img src = "CSS/images/search.png" />
		   			</center><br />
		   		</form>
		   		<p class = "sort_record_p">Sort record order by: 
		   			<select id = "sort_current_record_by" class = 'select_tag'>
		   				<option>date</option>
		   				<option>firstname</option>
		   				<option>lastname</option>
		   				<option>address</option>
		   			</select></p>
			 		<table id = "current_record_table" border = "1">
			 		</table>
		 		</div><!-- current record div ends -->
		   	
		   	<div id = "check_out_record_div">
		   		<center>
                    <input type = "text" class = "search_field" id = "check_out_record_search_field" name = "check_out_record_search_field" placeholder = "SEARCH" />
                    <img src = "CSS/images/search.png" />
                </center><br />
		   		<p class = "sort_record_p">Sort record order by: 
		   			<select id = "sort_checked_out_record_by" class = 'select_tag'>
		   				<option>date checked in</option>
		   				<option>date checked out</option>
		   				<option>firstname</option>
		   				<option>lastname</option>
		   				<option>address</option>
		   			</select>
		   			<button id = "check_out_show_action_button" class = 'attendant_button'>show action</button>
		   			<button id = "check_out_hide_action_button" class = 'attendant_button'>hide action</button>
		   			<span id = "mark_unmark_option_span"><span id = "mark_all_span">&laquo;mark all&raquo;</span> <span id = "unmarked_all_span">&laquo;unmark all&raquo;</span></span>
		   		</p><!-- sort_record_p end-->
		   		
		   		<table id = "check_out_record_table" border = "1">
		   		</table>
		   	</div><!-- check_out record div ends -->
		   	
		   	<div id = "payment_record_div">
		   		<center>
		   			<form id = "payment_record_select_form">
							<select id = "payment_record_select_month" name = "payment_record_select_month" ></select>
							<input type = "hidden" name = "payment_record_select_date" id = "payment_record_select_date" />
							<span id = "current_date_viewed_payment_record_span"></span>, 
							<select id = "payment_record_select_year" name = "payment_record_select_year"></select><br />
							RECORD
		   			</form>
		   		</center><br />
		   		<table id = "previous_next_table"><tr id = 'previous_next_tr'><th id = 'payment_record_previous_th'><accr title = "show record in previous date"><button onclick = 'view_previous_payment_record()'><img src = "CSS/images/previous1.png" /></button></accr></th><th></th><th></th><th id = 'payment_record_next_th'><accr title = "show next record"><button onclick = 'view_next_payment_record()'><img src = "CSS/images/next1.png" /></button></accr></th></tr></table>
		     		<table id = "payment_record_table" border = "1">
		     		</table>
		     		<p id = "payment_record_total_p">Today Total: <span id = "payment_record_daily_total"></span></p>
		     	</div><!-- payment record div ends -->
		     	
		     	<div id = "notes_div">
		     		<center><button id = "add_notes_button" class = 'attendant_button'>ADD NOTES</button></center><br />
		     		<div id = "add_notes_div">
		     			<center><accr title = "close"><img src = "CSS/images/close.png" id = "close_note"/></accr></center>
		     			<form>
				  			<table>
				  				<tr>
				  					<td>About:</td><td><input type = "text" id = "note_about" name = "note_about" /></td>
				  				</tr>
				  				<tr>
				  					<td></td><td><textarea id = "note_description" name = "note_description" placeholder = "Note despcription"></textarea></td>
				  				</tr>
				  			</table>
				  			<p class = "warning" id = "note_warning">Something is missing! :P</p>
		     				<center><input type = "button" id = "post_note_button" value = "POST" class = 'attendant_button'/><input type = "reset" id = "save_note_button" value = "save" class = 'attendant_button'/></center>
		     			</form><br />
		     		</div><!-- add notes div -->
		     		<div id = "all_notes_div"></div>
		     	</div><!-- notes div ends -->
		     	
		</div><!--buttons div ends-->	 
		
	</div><!--main div ends!-->
	
		<!-- HIDDEN ELEMENTS [warnings] [dialogs] [hidden inputs] -->
		<div id = "amount_change_div" title = "PAYMENT!"></div>
		<div id = "delete_note_confirmation" title = "DELETE CONFIRMATION">
			<img src = "CSS/images/delete1.png" />Are you sure to delete this NOTE? It can not be restored later!
		</div>
		<div id = "check_out_confirmation" title = "CHECK OUT CONFIRMATION">
			Sure to check out customer?
		</div>
		<div id = "delete_checked_out_record_confirmation" title = "DELETE CONFIRMATION">
			<img src = "CSS/images/warning2.png" >Sure to delete this record? It can't be restored later!
		</div>
	
		<input type = "hidden" name = "current_time" id = "current_time" />
		<input type = "hidden" name = "id" id = "id" />
		<input type = "hidden" name = "current_user_id" id = "current_user_id" />
		<form id = "current_day_form">
			<input type = "hidden" name = "current_month" id = "current_month" />
			<input type = "hidden" name = "current_date" id = "current_date" />
			<input type = "hidden" name = "current_year" id = "current_year" />
		</form>

        <script src = "JS/jquery-1.9.1.min.js"></script>
        <script src = "JS/jquery-ui-1.10.2.min.js"></script>
        <script src = "JS/hotel_page_functionality.js"></script>
        <script src = "JS/hotel_data.js"></script>
   </body>
</html>
