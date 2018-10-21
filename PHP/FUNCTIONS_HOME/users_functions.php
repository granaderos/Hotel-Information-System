<?php
	
	include "database_connection.php";

	class Users_functions extends Database_connection {
		
		function check_user($username_entered, $password_entered, $type_entered) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE username = ? AND password = password(?) AND type = ?");
			$select_statement->execute(array($username_entered, $password_entered, $type_entered));
			
			if($select_statement->fetch()) {
				return true;
			}
			
			$this->close_connection();
		}
	
		function determine_current_user($username) {
			$this->open_connection();
		
			$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE username = ?;");
			$select_statement->execute(array($username));
		
			$content = $select_statement->fetch();
		
			$data_array = array("user_id"=> $content[0], "user_fullname"=>$content[1]." ".$content[2]);
			$encoded_data = json_encode($data_array);
			echo $encoded_data;
		
			$this->close_connection();
		}
	
	}
?>
