<?php
   
   session_start();
   
   include "database_connection.php";
   
   class Hotel_data_functions extends Database_connection {

    function get_current_date() {
        $this->open_connection();

        $select_statement = $this->dbh->query("SELECT CONCAT(CURDATE(), ' ', CURTIME());");
        $current_date = $select_statement->fetch();
        return $current_date[0];

        $this->close_connection();
    }

   	function display_rooms() {
   		$this->open_connection();
   		
   		$select_statement = $this->dbh->query("SELECT * FROM rooms;");

   		while($content = $select_statement->fetch()) {
   		
   			if($content[5] == "available") {
					echo "<div class = 'for_available_rooms_div' id = '".$content[0]."' onclick = 'occupy_room(".$content[0].")'>
								<accr title = 'click to occupy or reserve'><table>
									<tr>
										<td>ROOM <span class = 'room_number'>".$content[1]."</span></td>
									</tr>
									<tr>
										<td>TYPE: ".$content[2]."</td>
									</tr>
									<tr>
										<td>FLOOR: ".$content[3]."</td>
									</tr>
								</table></accr>
							</div>";
   			}
   			
   			if($content[5] == "occupied") {
                    $select_statement2 = $this->dbh->prepare("SELECT CONCAT(c.lastname, ', ', c.firstname)
                                                                FROM customers AS c,
                                                                     rooms AS r,
                                                                     customer_to_room As cr
                                                               WHERE c.customer_id = cr.customer_id AND
                                                                     r.room_id = cr.room_id AND
                                                                     r.room_id = ?;");
                    $select_statement2->execute(array($content[0]));
                    $occupant_name = $select_statement2->fetch();
					echo "<div class = 'for_occupied_rooms_div' id = '".$content[0]."'>
								<table>
									<tr>
										<td>ROOM <span class = 'room_number'>".$content[1]."</span></td>
									</tr>
									<tr>
										<td>TYPE: ".$content[2]."</td>
									</tr>
									<tr>
										<td>FLOOR: ".$content[3]."</td>
									</tr>
									<tr>
									    <td>OCCUPANT:<span> ".$occupant_name[0]."</span></td>
									</tr>
								</table>
							</div>";
   			}
   			
   			if($content[5] == "reserved") {
					echo "<div class = 'for_reserved_rooms_div' id = '".$content[0]."' onclick = 'occupy_reserved_room(".$content[0].")'>
								<accr title = 'click to occupy this reserved room'>
									<table>
										<tr>
											<td>ROOM <span class = 'room_number'>".$content[1]."</span></td>
										</tr>
										<tr>
											<td>TYPE: ".$content[2]."</td>
										</tr>
										<tr>
											<td>FLOOR: ".$content[3]."</td>
										</tr>
									</table>
								</accr>
							</div>";
   			}
   			
   			if($content[5] == "out of order") {
					echo "<div class = 'for_out_of_order_rooms_div' id = '".$content[0]."'>
								<table>
									<tr>
										<td>ROOM <span class = 'room_number'>".$content[1]."</span></td>
									</tr>
									<tr>
										<td>TYPE: ".$content[2]."</td>
									</tr>
									<tr>
										<td>FLOOR: ".$content[3]."</td>
									</tr>
								</table>
							</div>";
   			}
   			
   		}
   		
   		$this->close_connection();
   	}
      
      function retrieve_room_number_to_occupy($id) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->prepare("SELECT room_number, room_price FROM rooms WHERE room_id = ?;");
      	$select_statement->execute(array($id));
      	
      	$content = $select_statement->fetch();
      	
      	$data_array = array("room_number"=>$content[0], "room_price"=>$content[1]);
      	$encoded_data = json_encode($data_array);
      	
      	echo $encoded_data;
      	
      	$this->close_connection();
      }
      
      function add_check_in($firstname, $lastname, $gender, $age, $contact_number, $address, $amount_given, $amount_to_pay, $room_id) {
      	$this->open_connection();

        $firstname = ucwords($firstname);
        $lastname = ucwords($lastname);
        $address = ucwords($address);

      	$insert_statement = $this->dbh->prepare("INSERT INTO customers VALUES (null, ?, ?, ?, ?, ?, ?);");
      	$insert_statement->execute(array($firstname, $lastname, $gender, $age, $contact_number, $address));
      	
      	$customer_id = $this->dbh->lastInsertId();
      	
      	$update_statement = $this->dbh->prepare("UPDATE rooms SET room_status = 'occupied' WHERE room_id = ?;");
      	$update_statement->execute(array($room_id));

      	$insert_statement2 = $this->dbh->prepare("INSERT INTO customer_to_room VALUES (null, ?, ?, ?, null);");

      	$insert_statement2->execute(array($customer_id, $room_id, $this->get_current_date()));
      	
      	$select_statement = $this->dbh->prepare("SELECT room_number FROM rooms WHERE room_id = ?;");
      	$select_statement->execute(array($room_id));
      	
      	//$room_number = $select_statement->fetch();

      	if($amount_given != "" && $amount_to_pay != "") {
      		$this->add_payment($customer_id, $amount_to_pay);
      	}

      	$this->close_connection();
      }

      function get_total_days_of_stay_base_on_entered_date_of_check_out($date_of_check_out, $customer_id) {
          $this->open_connection();

          $length = strpos($date_of_check_out, ":");
          $date_of_out = "";
          $current_date = "";

          for($counter = 0; $counter < strpos($date_of_check_out, " "); $counter++) {
            $date_of_out .= $date_of_check_out[$counter];
          }
          $get_current_date = $this->get_current_date();

          for($counter = 0; $counter < $length; $counter++) {
              $current_date .= $get_current_date[$counter];
          }

          if($date_of_out == $current_date) {
              $select_statement1 = $this->dbh->prepare("SELECT cr.time_checked_in
                                                        FROM customers AS c,
                                                             rooms AS r,
                                                             customer_to_room AS cr
                                                        WHERE c.customer_id = cr.customer_id AND
                                                              r.room_id = cr.room_id AND
                                                              c.customer_id = ?;");
              $select_statement1->execute(array($customer_id));
              $date_checked_in = $select_statement1->fetch();
              $select_statement2 = $this->dbh->prepare("SELECT DATEDIFF(?, ?)");
              $select_statement2->execute(array($date_of_check_out, $date_checked_in[0]));
              $days_of_stay = $select_statement2->fetch();
              //echo $days_of_stay[0];
          } else {
              $select_statement = $this->dbh->prepare("SELECT DATEDIFF(?, ?)");
              $select_statement->execute(array($date_of_check_out, $this->get_current_date()));
              $days_of_stay = $select_statement->fetch();
              echo $days_of_stay[0];
          }
          $this->close_connection();
      }
      
      function add_payment($customer_id, $amount_to_pay) {
      	$this->open_connection();

	   	$insert_statement = $this->dbh->prepare("INSERT INTO payment_record VALUES (null, ?, ?);");
	   	$insert_statement->execute(array($customer_id, $amount_to_pay));

      	$this->close_connection();
      }
      
      function display_current_record($sort_current_record_by){
         $this->open_connection();
         
         if($sort_current_record_by == "date") {
         	$select_statement = $this->dbh->query("SELECT c.customer_id, r.room_number, c.firstname, c.lastname, c.gender, c.age, c.contact_number, c.address, cr.time_checked_in FROM customers AS c, rooms AS r, customer_to_room AS cr WHERE cr.customer_id = c.customer_id AND r.room_id = cr.room_id AND r.room_status = 'occupied' ORDER BY cr.time_checked_in DESC;");
		  		
		  		echo "<tr><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>CHECK-OUT</th></tr>";
		  		
		  		while($content = $select_statement->fetch()) {
		  			echo "<tr id = '".$content[0]."'>
		  					<td>".$content[1]."</td>
		   				<td>".$content[2]." ".$content[3]."</td>
		   				<td>".$content[4]."</td>
		   				<td>".$content[5]."</td>
		   				<td>".$content[6]."</td>
		   				<td>".$content[7]."</td>
		   				<td>".$content[8]."</td>
		   				<td class = 'td_check_out' onclick = 'check_out_customer(".$content[0].")'>check-out</td>
		  					</tr>";
		  		}
         } else {
		  		$select_statement = $this->dbh->query("SELECT c.customer_id, r.room_number, c.firstname, c.lastname, c.gender, c.age, c.contact_number, c.address, cr.time_checked_in FROM customers AS c, rooms AS r, customer_to_room AS cr WHERE cr.customer_id = c.customer_id AND r.room_id = cr.room_id AND r.room_status = 'occupied' ORDER BY c.".$sort_current_record_by.";");
		  		
		  		echo "<tr><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>CHECK-OUT</th></tr>";
		  		
		  		while($content = $select_statement->fetch()) {
		  			echo "<tr id = '".$content[0]."'>
		  					<td>".$content[1]."</td>
		   				<td>".$content[2]." ".$content[3]."</td>
		   				<td>".$content[4]."</td>
		   				<td>".$content[5]."</td>
		   				<td>".$content[6]."</td>
		   				<td>".$content[7]."</td>
		   				<td>".$content[8]."</td>
		   				<td class = 'td_check_out' onclick = 'check_out_customer(".$content[0].")'>check-out</td>
		  					</tr>";
		  		}
		  	}
         $this->close_connection();
      }
      
      function check_customer_payment($id) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->prepare("SELECT * FROM payment_record WHERE customer_id = ?;");
      	$select_statement->execute(array($id));
      	
      	if($select_statement->fetch()) {
      		echo "customer was already paid";
      	} else {
            $select_statement1 = $this->dbh->prepare("SELECT room_price FROM rooms AS r, customers AS c, customer_to_room AS cr WHERE c.customer_id = cr.customer_id AND r.room_id = cr.room_id AND cr.customer_id = ?");
            $select_statement1->execute(array($id));

            $room_price = $select_statement1->fetch();
            echo $room_price[0];
         }
      	
      	$this->close_connection();
      }
      
      function check_out_customer($id, $current_time) {
      	$this->open_connection();
      	
  			$select_statement = $this->dbh->prepare("SELECT room_id FROM customer_to_room WHERE customer_id = ?;");
  			$select_statement->execute(array($id));
      	
      	$room_id = $select_statement->fetch();
      	
      	$update_statement = $this->dbh->prepare("UPDATE rooms SET room_status = 'available' WHERE room_id = ?;");
      	$update_statement->execute(array($room_id[0]));
      	
      	$update_statement2 = $this->dbh->prepare("UPDATE customer_to_room SET time_checked_out = ? WHERE customer_id = ? ");
      	$update_statement2->execute(array($current_time, $id));
      	
      	$this->close_connection();
      }
      
      function display_checked_out_record($sort_checked_out_record_by) {
      	$this->open_connection();
      	
      	if($sort_checked_out_record_by == "date checked in") {
      		$select_statement = $this->dbh->query("SELECT c.customer_id, r.room_number, c.firstname, c.lastname, c.gender, c.age, c.contact_number, c.address, cr.time_checked_in, cr.time_checked_out FROM customers AS c, rooms AS r, customer_to_room AS cr WHERE cr.customer_id = c.customer_id AND r.room_id = cr.room_id AND cr.time_checked_out != 'none' ORDER BY time_checked_in DESC;");
      	
		   	echo "<tr id = 'thead_row'><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>TIME CHECKED OUT</th></tr>";
		   	
		   	while($content = $select_statement->fetch()) {
		   		echo "<tr id = '".$content[0]."'>
			  					<td>".$content[1]."</td>
								<td>".$content[2]." ".$content[3]."</td>
								<td>".$content[4]."</td>
								<td>".$content[5]."</td>
								<td>".$content[6]."</td>
								<td>".$content[7]."</td>
								<td>".$content[8]."</td>
								<td>".$content[9]."</td>
								<td class = 'checkbox_td'><input type = 'checkbox' class = 'check_wew' name = 'out_checkbox[]' id = 'out_".$content[0]."' value = '".$content[0]."' /></td>
		  					</tr>";
		   	}
      	} else {
      	
		   	if($sort_checked_out_record_by == "date checked out") {
		   		$select_statement = $this->dbh->query("SELECT c.customer_id, r.room_number, c.firstname, c.lastname, c.gender, c.age, c.contact_number, c.address, cr.time_checked_in, cr.time_checked_out FROM customers AS c, rooms AS r, customer_to_room AS cr WHERE cr.customer_id = c.customer_id AND r.room_id = cr.room_id AND cr.time_checked_out != 'none' ORDER BY time_checked_out DESC;");
		   	
					echo "<tr id = 'thead_row'><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>TIME CHECKED OUT</th></tr>";
					
					while($content = $select_statement->fetch()) {
						echo "<tr id = '".$content[0]."'>
			  					<td>".$content[1]."</td>
								<td>".$content[2]." ".$content[3]."</td>
								<td>".$content[4]."</td>
								<td>".$content[5]."</td>
								<td>".$content[6]."</td>
								<td>".$content[7]."</td>
								<td>".$content[8]."</td>
								<td>".$content[9]."</td>
								<td class = 'checkbox_td'><input type = 'checkbox' class = 'check_wew' name = 'out_checkbox[]' id = 'out_".$content[0]."' value = '".$content[0]."' /></td>
			  					</tr>";
					}
		   	} else {
		   	
					$select_statement = $this->dbh->query("SELECT c.customer_id, r.room_number, c.firstname, c.lastname, c.gender, c.age, c.contact_number, c.address, cr.time_checked_in, cr.time_checked_out FROM customers AS c, rooms AS r, customer_to_room AS cr WHERE cr.customer_id = c.customer_id AND r.room_id = cr.room_id AND cr.time_checked_out != 'none' ORDER BY c.".$sort_checked_out_record_by.";");
					
					echo "<tr id = 'thead_row'><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>TIME CHECKED OUT</th></tr>";
					
					while($content = $select_statement->fetch()) {
						echo "<tr id = '".$content[0]."'>
			  					<td>".$content[1]."</td>
								<td>".$content[2]." ".$content[3]."</td>
								<td>".$content[4]."</td>
								<td>".$content[5]."</td>
								<td>".$content[6]."</td>
								<td>".$content[7]."</td>
								<td>".$content[8]."</td>
								<td>".$content[9]."</td>
								<td class = 'checkbox_td'><input type = 'checkbox' class = 'check_wew' name = 'out_checkbox[]' id = 'out_".$content[0]."' value = '".$content[0]."' /></td>
			  					</tr>";
					}
		   	}
		   }
      	$this->close_connection();
      }
      
      function delete_checked_out_record($id) {
      	$this->open_connection();
      	
      	$delete_statement = $this->dbh->prepare("DELETE FROM customers WHERE customer_id = ?;");
      	$delete_statement->execute(array($id));
      	
      	echo "id ni gikan sa php = ".$id;
      	
      	$this->close_connection();
      }
      
      function display_payment_record(/*$payment_record_select_month, $payment_record_select_date, $payment_record_select_year*/) {
      	$this->open_connection();

          $select_statement1 = $this->dbh->query("SELECT DISTINCT date(cr.time_checked_in)
                                                     FROM customers AS c,
                                                          rooms AS r,
                                                          customer_to_room AS cr,
                                                          payment_record AS p
                                                    WHERE c.customer_id = cr.customer_id AND
                                                          r.room_id = cr.room_id AND
                                                          c.customer_id = p.customer_id;");

          while($date = $select_statement1->fetch()) {
              $select_statement = $this->dbh->prepare("SELECT CONCAT(c.lastname, ', ', c.firstname),
                                                          r.room_number,
                                                          p.amount_to_pay
                                                     FROM customers AS c,
                                                          rooms AS r,
                                                          customer_to_room AS cr,
                                                          payment_record AS p
                                                    WHERE c.customer_id = cr.customer_id AND
                                                          r.room_id = cr.room_id AND
                                                          date(cr.time_checked_in) = ? AND
                                                          c.customer_id = p.customer_id;");
              $select_statement->execute(array($date[0]));
              echo "<tr><td><table>";
              echo "<tr><td colspan = '3'>Date: ".$date[0]."</td></tr>";
              echo "<tr><th>Customer Name</th><th>Room Occupied</th><th>Payment</th></tr>";
              while($content = $select_statement->fetch()) {
                  echo "<tr>
                            <td>".$content[0]."</td>
                            <td>".$content[1]."</td>
                            <td>".$content[2]."</td>
                        </tr>";
              }
              $select_statement2 = $this->dbh->prepare("SELECT SUM(p.amount_to_pay)
                                                          FROM customers AS c,
                                                              rooms AS r,
                                                              customer_to_room AS cr,
                                                              payment_record AS p
                                                        WHERE c.customer_id = cr.customer_id AND
                                                              r.room_id = cr.room_id AND
                                                              date(cr.time_checked_in) = ? AND
                                                              c.customer_id = p.customer_id; ");
              $select_statement2->execute(array($date[0]));
              $daily_total = $select_statement2->fetch();
              echo "<tr><td colspan = '3'>Daily Total Income: ".$daily_total[0]."</td></tr>";
              echo "</table></td></tr>";
          }

            /*
            while($content = $select_statement->fetch()) {
                echo "<tr>

                      </tr>";
            }*/

          /*
          $month_array = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
          for($counter = 0; $counter < sizeof($month_array); $counter++) {
              if($month_array[$counter] == $payment_record_select_month) {
                  if($counter < 10) {
                      $counter = $counter + 1;
                      $payment_record_select_month = '0'.$counter;

                  } else {
                    $payment_record_select_month = $counter + 1;

                  }
              }
          }

          $date_to_dispay = $payment_record_select_year."-".$payment_record_select_month."-".$payment_record_select_date;
      	  $select_statement = $this->dbh->prepare("SELECT c.firstname,
      	                                                  c.lastname,
      	                                                  p.amount_given,
      	                                                  p.amount_to_pay,
      	                                                  p.amount_change
      	                                            FROM customers as c,
      	                                                 customer_to_room AS cr,
      	                                                 payment_record AS p
      	                                            WHERE c.customer_id = cr.customer_id AND
      	                                                  c.customer_id = p.customer_id AND
      	                                                  ((SELECT DATE(cr.time_checked_in)) = ? OR
      	                                                  (SELECT DATE(cr.time_checked_out)) = ?)");

      	  $select_statement->execute(array($date_to_dispay, $date_to_dispay));

			$counter = 0;
			while($content = $select_statement->fetch()) {
	   		    while($counter < 1) {
					echo "<tr><th>CUSTOMER</th><th>AMOUNT GIVEN</th><th>AMOUNT TO PAY</th><th>AMOUNT CHANGE</th></tr>";
					$counter++;
				}
                $change = $content[2] - $counter[3];
	   		echo "<tr>
	   					<td>".$content[0]." ".$content[1]."</td>
	   					<td>&#8369;".$content[2]."</td>
	   					<td>&#8369;".$content[3]."</td>
	   					<td>&#8369;".$change."</td>
	   				</tr>";
	   	    }*/
		  
      	$this->close_connection();
      }
      
      function get_daily_total_income($payment_record_select_month, $payment_record_select_date, $payment_record_select_year) {
      	$this->open_connection();

          $month_array = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
          for($counter = 0; $counter < sizeof($month_array); $counter++) {
              if($month_array[$counter] == $payment_record_select_month) {
                  if($counter < 10) {
                      $counter = $counter + 1;
                      $payment_record_select_month = '0'.$counter;

                  } else {
                      $payment_record_select_month = $counter + 1;

                  }
              }
          }

          $date = $payment_record_select_year."-".$payment_record_select_month."-".$payment_record_select_date;

      	$select_statement = $this->dbh->prepare("SELECT SUM(p.amount_to_pay)
      	                                         FROM payment_record AS p,
      	                                              customers AS c,
      	                                              customer_to_room AS cr
      	                                         WHERE c.customer_id = cr.customer_id AND
      	                                               c.customer_id = p.customer_id AND
      	                                               ((SELECT DATE(cr.time_checked_in)) = ? OR
      	                                               (SELECT DATE(cr.time_checked_out)) = ?);");
      	$select_statement->execute(array($date, $date));
      	
      	$total = $select_statement->fetch();
      	
      	if($total[0] != "") {
      		echo "&#8369;".$total[0].".00";
      	} else {
      		echo "&#8369;0.00";
      	}
      	
      	$this->close_connection();
      }

      
      function search_current_record_lastname($name_entered) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->prepare("SELECT c.customer_id,
      	                                              r.room_number,
      	                                              c.firstname,
      	                                              c.lastname,
      	                                              c.gender,
      	                                              c.age,
      	                                              c.contact_number,
      	                                              c.address,
      	                                              cr.time_checked_in
      	                                         FROM customers AS c,
      	                                              rooms AS r,
      	                                              customer_to_room AS cr
      	                                         WHERE c.customer_id = cr.customer_id AND
      	                                               r.room_id = cr.room_id AND
      	                                               r.room_status = 'occupied' AND
      	                                               c.lastname LIKE ? OR
      	                                               c.firstname LIKE ?
      	                                         ORDER BY time_checked_in DESC;");
          $select_statement->execute(array($name_entered, $name_entered));
      	
      	$counter = 0;
      	
      	while($content = $select_statement->fetch()) {
      		while($counter < 1) {
      			echo "<tr><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>CHECK-OUT</th></tr>";
      			$counter++;
      		}
      		echo "<tr id = '".$content[0]."'>
     					<td>".$content[1]."</td>
      				<td>".$content[2]." ".$content[3]."</td>
      				<td>".$content[4]."</td>
      				<td>".$content[5]."</td>
      				<td>".$content[6]."</td>
      				<td>".$content[7]."</td>
      				<td>".$content[8]."</td>
      				<td class = 'td_check_out' onclick = 'check_out_customer(".$content[0].")'>check-out</td>
     					</tr>";
      	}
      	
      	$this->close_connection();
      }
      
      function search_current_record($firstname, $lastname) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->query("SELECT c.customer_id, r.room_number, c.firstname, c.lastname, c.gender, c.age, c.contact_number, c.address, cr.time_checked_in FROM customers AS c, rooms AS r, customer_to_room AS cr WHERE c.customer_id = cr.customer_id AND r.room_id = cr.room_id AND r.room_status = 'occupied' AND c.firstname LIKE '".$firstname."%'c.lastname LIKE '".$lastname."%' ORDER BY time_checked_in DESC;");
      	
      	$counter = 0;
      	
      	while($content = $select_statement->fetch()) {
      		while($counter < 1) {
      			echo "<tr><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>CHECK-OUT</th></tr>";
      			$counter++;
      		}
      		echo "<tr id = '".$content[0]."'>
     					<td>".$content[1]."</td>
      				<td>".$content[2]." ".$content[3]."</td>
      				<td>".$content[4]."</td>
      				<td>".$content[5]."</td>
      				<td>".$content[6]."</td>
      				<td>".$content[7]."</td>
      				<td>".$content[8]."</td>
      				<td class = 'td_check_out' onclick = 'check_out_customer(".$content[0].")'>check-out</td>
     					</tr>";
      	}
      	$this->close_connection();
      }
      
      function search_check_out_record($name_entered) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->query("SELECT c.customer_id, r.room_number, c.firstname, c.lastname, c.gender, c.age, c.contact_number, c.address, cr.time_checked_in, cr.time_checked_out FROM customers AS c, rooms AS r, customer_to_room AS cr WHERE cr.customer_id = c.customer_id AND r.room_id = cr.room_id AND cr.time_checked_out != 'none' AND c.firstname LIKE '".$name_entered."%' ORDER BY time_checked_in DESC;");
      	
      	$counter = 0;
      	
      	while($content = $select_statement->fetch()) {
      		while($counter < 1) {
      			echo "<tr><th>ROOM</th><th>CUSTOMER</th><th>GENDER</th><th>AGE</th><th>CONTACT</th><th>ADDRESS</th><th>TIME CHECKED IN</th><th>TIME CHECKED OUT</th></tr>";
      			$counter++;
      		}
      		echo "<tr id = '".$content[0]."'>
     					<td>".$content[1]."</td>
      				<td>".$content[2]." ".$content[3]."</td>
      				<td>".$content[4]."</td>
      				<td>".$content[5]."</td>
      				<td>".$content[6]."</td>
      				<td>".$content[7]."</td>
      				<td>".$content[8]."</td>
      				<td>".$content[9]."</td>
     					</tr>";
      	}
      	
      	$this->close_connection();
      } 
      
      function search_payment_record($name_entered) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->query("SELECT c.firstname, c.lastname, p.amount_given, p.amount_to_pay, p.amount_change FROM customers as c, payment_record AS p WHERE c.customer_id = p.customer_id AND c.firstname LIKE '".$name_entered."%';");
      	
      	$counter = 0;
      	
      	while($content = $select_statement->fetch()) {
      		while($counter < 1) {
      			echo "<tr><th>CUSTOMER</th><th>AMOUNT GIVEN</th><th>AMOUNT TO PAY</th><th>AMOUNT CHANGE</th></tr>";
      			$counter++;
      		}
      		echo "<tr>
      					<td>".$content[0]." ".$content[1]."</td>
      					<td>&#8369;".$content[2]."</td>
      					<td>&#8369;".$content[3]."</td>
      					<td>&#8369;".$content[4]."</td>
      				</tr>";
      	}
      	
      	$this->close_connection();
      }
      
      function add_reservation($room_id, $reserve_to_firstname, $reserve_to_lastname) {
      	$this->open_connection();
      	
      	$insert_statement = $this->dbh->prepare("INSERT INTO reservations VALUES (null, ?, ?, ?);");
      	$insert_statement->execute(array($room_id, $reserve_to_firstname, $reserve_to_lastname));
      	
      	$update_statement = $this->dbh->prepare("UPDATE rooms SET room_status = 'reserved' WHERE room_id = ?;");
      	$update_statement->execute(array($room_id));
      	
      	$this->close_connection();
      }
      
      function retrieve_reserved_data($id) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->prepare("SELECT rr.reserve_to_firstname, rr.reserve_to_lastname, r.room_number FROM reservations AS rr, rooms AS r WHERE rr.room_id = ? AND r.room_id = rr.room_id AND r.room_status = 'reserved';");
      	$select_statement->execute(array($id));
      	
      	$content = $select_statement->fetch();
      	
      	$data_array = array("reserve_to_firstname"=>$content[0], "reserve_to_lastname"=>$content[1], "room_number"=>$content[2]);
      	$encoded_data = json_encode($data_array);
      	
      	echo $encoded_data;
      	
      	$this->close_connection();
      }
      
      function add_notes($current_user_id, $note_about, $note_description, $current_time) {
      	$this->open_connection();
      	
      	$spaceless_note_about = trim($note_about);
      	$spaceless_note_description = trim($note_description);
      	
         $final_description = htmlentities($note_description);
      	$final_description = nl2br($final_description);
      	
      	if(!empty($spaceless_note_about) && !empty($spaceless_note_description)) {
		   	$insert_statement = $this->dbh->prepare("INSERT INTO notes VALUES (null, ?, ?, ?, ?);");
		   	$insert_statement->execute(array($current_user_id, htmlentities($note_about), $final_description, $current_time));
		   	
		   	$note_id = $this->dbh->lastInsertId();
		   	
		   	echo "<div class = 'new_added_notes' id = 'note_".$note_id."'>
		   				<button onclick = 'delete_note(".$note_id.")'><img src = 'CSS/images/delete.png'></button>
		   				<button onclick = 'edit_note(".$note_id.")'><img src = 'CSS/images/edit.png'></button>
		   				About:<span class = 'note_about_span'> ".htmlentities($note_about)."</span><br />
		   				<p class = 'note_description_p'>".$final_description."</p>
		   				<span class = 'note_posted_span'>POSTED: ".$current_time."</span>
		   			</div>";
      	}
      	
      	$this->close_connection();
      }
      
      function display_notes() {
      	$this->open_connection();
      	
      	$select_statement1 = $this->dbh->prepare("SELECT user_id FROM users WHERE username = ?;");
      	$select_statement1->execute(array($_SESSION["username_entered"]));
      	
      	$user_id = $select_statement1->fetch();
      	
      	$select_statement = $this->dbh->prepare("SELECT notes.note_id, notes.user_id, notes.about, notes.note_description, notes.time_posted FROM notes, users WHERE notes.user_id = users.user_id AND notes.user_id = ? ORDER BY time_posted DESC;");
      	$select_statement->execute(array($user_id[0]));
      	
      	while($content = $select_statement->fetch()) {
      		echo "<div class = 'new_added_notes' id = 'note_".$content[0]."'>
		   				<button onclick = 'delete_note(".$content[0].")'><img src = 'CSS/images/delete.png' /></button>
		   				<button onclick = 'edit_note(".$content[0].")'><img src = 'CSS/images/edit.png' /></button>
		   				About:<span class = 'note_about_span'> ".$content[2]."</span><br />
		   				<p class = 'note_description_p'>".$content[3]."</p>
		   				<span class = 'note_posted_span'>POSTED: ".$content[4]."</span>
		   			</div>";
		   }

      	$this->close_connection();
      }
      
      function retrieve_note($id) {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->prepare("SELECT * FROM notes WHERE note_id = ?;");
      	$select_statement->execute(array($id));
      	
      	$content = $select_statement->fetch();
      	
      	$data_array = array("note_id"=>$content[0], "note_about"=>html_entity_decode($content[2]), "note_description"=>html_entity_decode($content[3]));
      	$encoded_data = json_encode($data_array);
      	
      	echo $encoded_data;
      	
      	$this->close_connection();
      }
      
      function edit_notes($id, $note_about, $note_description, $current_time) {
      	$this->open_connection();
      	
      	$update_statement = $this->dbh->prepare("UPDATE notes SET about = ?, note_description = ?, time_posted = ? WHERE note_id = ?;");
      	$update_statement->execute(array(htmlentities($note_about), htmlentities($note_description), $current_time, $id));
      	
      	echo "<button onclick = 'delete_note(".$id.")'><img src = 'CSS/images/delete.png' /></button>
      			<button onclick = 'edit_note(".$id.")'><img src = 'CSS/images/edit.png' /></button>
   				About:<span class = 'note_about_span'> ".htmlentities($note_about)."</span><br />
   				<p class = 'note_description_p'>".htmlentities($note_description)."</p>
   				<span class = 'note_posted_span'>POSTED: ".$current_time."</span>";
      	
      	$this->close_connection();
      }
      
      function delete_notes($id) {
      	$this->open_connection();
      	
      	$delete_statement = $this->dbh->prepare("DELETE FROM notes WHERE note_id = ?");
      	$delete_statement->execute(array($id));
      	
      	$this->close_connection();
      }
      
      // ------------------- FOR ADMINISTRATOR'S FUNCTIONS -----------------
      
      function admin_display_all_rooms() {
      	$this->open_connection();
      	
      	$select_statement = $this->dbh->query("SELECT * FROM rooms;");
      	
      	echo "<tr><th>ROOM No.</th><th>TYPE</th><th>FLOOR No.</th><th>ROOM PRICE</th><th>STATUS</th><th>ACTION</th></tr>";
      	
      	while($content = $select_statement->fetch()) {
      		echo "<tr id = 'room_".$content[0]."'>
      					<td>".$content[1]."</td>
      					<td>".$content[2]."</td>
      					<td>".$content[3]."</td>
      					<td>&#8369;".$content[4]."</td>
      					<td>".$content[5]."</td>
      					<td>[ <img src = 'CSS/images/edit.png' class = 'edit' onclick = 'edit_room(".$content[0].")'> ]
      						 [ <img src = 'CSS/images/delete.png' class = 'delete' onclick = 'delete_room(".$content[0].")'> ]</td>
      				</tr>";
      	}	
      	
      	$this->close_connection();
      }
      
     function add_room($room_number, $room_type, $floor_number, $room_price, $room_status) {
     	$this->open_connection();
     		
     		$insert_statement = $this->dbh->prepare("INSERT INTO rooms VALUES (null, ?, ?, ?, ?, ?)");
     		$insert_statement->execute(array($room_number, $room_type, $floor_number, $room_price, $room_status));
     		
     	$this->close_connection();	
     }
     
     function retrieve_room_data($id) {
     	$this->open_connection();
     	
     	$select_statement = $this->dbh->prepare("SELECT * FROM rooms WHERE room_id = ?;");
     	$select_statement->execute(array($id));
     	
     	$content = $select_statement->fetch();
     	
	  	$data_array = array("room_id"=>$content[0], "room_number"=>$content[1], "room_type"=>$content[2], "floor_number"=>$content[3], "room_price"=>$content[4],"room_status"=>$content[5]);
	  	$encoded_data = json_encode($data_array);
	  	
	  	echo $encoded_data;

		$this->close_connection();
     }
     
     function edit_room($id, $room_number, $room_type, $floor_number, $room_price, $room_status) {
     	$this->open_connection();
     	
     	$update_statement = $this->dbh->prepare("UPDATE rooms SET room_number = ?, room_type = ?, floor_number = ?, room_price = ?, room_status = ? WHERE room_id = ?");
     	$update_statement->execute(array($room_number, $room_type, $floor_number, $room_price, $room_status, $id));
     	
     	$this->close_connection();
     }
     
     function delete_room($id) {
     	$this->open_connection();
     	
     	$delete_statement = $this->dbh->prepare("DELETE FROM rooms WHERE room_id = ?;");
     	$delete_statement->execute(array($id));
     	
     	$this->close_connection();
     }
     
     function display_attendants() {
     	$this->open_connection();
     	
     	$select_statement = $this->dbh->query("SELECT * FROM users WHERE type = 'ATTENDANT';");
     	$counter = 0;
     	while($content = $select_statement->fetch()) {
     		while($counter < 1) {
     			echo "<tr><th>ID</th><th>NAME</th><th>GENDER</th><th>AGE</th><th>BIRTHDAY</th><th>ADDRESS</th><th>CONTACT NUMBER</th></tr>";
     			$counter++;
     		}
     		echo "<tr id = 'attendant_".$content[0]."'>
     					<td>".$content[0]."</td>
     					<td>".$content[1]." ".$content[2]."</td>
     					<td>".$content[3]."</td>
     					<td>".$content[4]."</td>
     					<td>".$content[5]."</td>
     					<td>".$content[6]."</td>
     					<td>".$content[7]."</td>
     				</tr>";
     	}
     	
     	$this->close_connection();
     }
     
     function add_attendant($attendant_firstname, $attendant_lastname, $attendant_gender, $attendant_age, $attendant_birth_month, $attendant_birth_date, $attendant_birth_year, $attendant_address, $attendant_contact_number, $attendant_username, $attendant_password) {
     	$this->open_connection();
     	
		// ***** checking new attendant's username ****** //
		
		$select_statement = $this->dbh->prepare("SELECT username FROM users WHERE username = ? AND type = 'ATTENDANT';");
		$select_statement->execute(array($attendant_username));
		
		if($select_statement->fetch()) {
			echo "Attendant's username was already taken!";
		} else {
			$type = "ATTENDANT";
			$birthday = $attendant_birth_month." ".$attendant_birth_date.", ".$attendant_birth_year;
			   
			$insert_statement = $this->dbh->prepare("INSERT INTO users VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, password(?), ?);");
			$insert_statement->execute(array(ucfirst($attendant_firstname), ucfirst($attendant_lastname), $attendant_gender, $attendant_age, $birthday, $attendant_address, $attendant_contact_number, $attendant_username, $attendant_password, $type));
		}
		
     	$this->close_connection();
     }
     
     function delete_attendant($attendant_id_to_delete) {
     	$this->open_connection();
     	
     	$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE user_id = ? AND type = 'ATTENDANT';");
     	$select_statement->execute(array($attendant_id_to_delete));
     	
     	if($select_statement->fetch()) {
     		$delete_statement = $this->dbh->prepare("DELETE FROM users WHERE user_id = ?;");
     		$delete_statement->execute(array($attendant_id_to_delete));
     	} else {
     		echo "ID doesn't belong to any Attendant!";
     	}
     	
     	$this->close_connection();
     }
     
     function retrieve_attendant_data($attendant_id_to_edit) {
     	$this->open_connection();
     	
     	$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE user_id = ? AND type = 'ATTENDANT';");
     	$select_statement->execute(array($attendant_id_to_edit));
     	
     	$content = $select_statement->fetch();
     	
     	if($content[1] != "") {
     	
		  	$data_array = array("user_id"=>$content[0], "firstname"=>$content[1], "lastname"=>$content[2], "gender"=>$content[3], "age"=>$content[4], "address"=>$content[6], "contact_number"=>$content[7], "username"=>$content[8], "password"=>md5($content[9]));
		  	$encoded_data = json_encode($data_array);
		  	
		  	echo $encoded_data;
     	}
     	
     	$this->close_connection();
     }
     
     function edit_attendant($attendant_firstname, $attendant_lastname, $attendant_gender, $attendant_age, $attendant_birth_month, $attendant_birth_date, $attendant_birth_year, $attendant_address, $attendant_contact_number, $attendant_username, $attendant_password, $id) {
     	$this->open_connection();
     	
     	$birthday = $attendant_birth_month." ".$attendant_birth_date." ".$attendant_birth_year;
     	
     	$update_statement = $this->dbh->prepare("UPDATE users SET firstname = ?, lastname = ?, gender = ?, age = ?, birthday = ?, address = ?, contact_number = ?, username = ?, password = password(?) WHERE user_id = ?;");
     	$update_statement->execute(array($attendant_firstname, $attendant_lastname, $attendant_gender, $attendant_age, $birthday, $attendant_address, $attendant_contact_number, $attendant_username, $attendant_password, $id));
     	
     	$this->close_connection();
     }
     
   }
?>
