<?php

	include "PHP/FUNCTIONS_HOME/users_functions.php";
	$execute = new Users_functions();
	
	session_start();	
	
	if(isset($_SESSION["type_entered"]) && $_SESSION["type_entered"] == "ADMINISTRATOR") {
		header("Location: hotel_admin_page.php");
	} else {
	
		if(isset($_SESSION["type_entered"]) && $_SESSION["type_entered"] == "ATTENDANT") {
			header("Location: hotel_page.php");
		} else {
	
			if(isset($_POST['username_entered']) && isset($_POST['password_entered']) && isset($_POST['type_entered'])) {
				$user_exist = $execute->check_user($_POST["username_entered"], $_POST["password_entered"], $_POST["type_entered"]);
				if($user_exist) {
					if($_POST["type_entered"] == "ATTENDANT") {
						$_SESSION["username_entered"] = $_POST["username_entered"];
						$_SESSION["type_entered"] = $_POST["type_entered"];
						header("Location: hotel_page.php");
					}
			
					if($_POST["type_entered"] == "ADMINISTRATOR") {
						$_SESSION["username_entered"] = $_POST["username_entered"];
						$_SESSION["type_entered"] = $_POST["type_entered"];
						header("Location: hotel_admin_page.php");
					}
					if($_POST["type_enetered"] == "select type") {
						$error_message = "Please select your type!";
					}
			
				} else {
					$error_message = "Unknown username or password. Or please ckeck your type.";
				}
			}
		}
	}
?>

<!Doctype html>
<html>
	<head>
        <title>log-in | hotel</title>
	    <script src = "JS/jquery-1.9.1.min.js"></script>
        <script src = "JS/jquery-ui-1.10.2.min.js"></script>
        <script src = "JS/bootstrap.min.js"></script>
        <link rel = "stylesheet" href = "CSS/jquery-ui.min.css" />
        <link rel = "stylesheet" href = "CSS/hotel_log_in.css" />
        <link rel = "stylesheet" href = "CSS/bootstrap.min.css" />
        <link rel = "shortcut icon" href = "CSS/images/t.jpeg">
        <script type = "text/javascript">
            $(function() {
                    $("#select_type_option").hide();
            });
        </script>
	</head>
	<body>
		<div id = "container_div">
			<h1><span>H</span>OTEL <span>M</span>ANAGEMENT & <span>C</span>USTOMER <span>E</span>NLISTMENT <span>S</span>YSTEM</h1>
			<div id = "log_in_div">
				
				<form id = "log_in_form" action = "hotel_log_in_page.php" method = "POST">
					<input type = "text" class = "input_class" id = "username_entered" name = "username_entered" placeholder = "username"/><br />
					<input type = "password" class = "input_class" id = "password_entered" name = "password_entered" placeholder = "password"/><br />
					<select id = "type_entered" name = "type_entered">
									<option id = "select_type_option">select type</option>
									<!--<option>GUEST</option>-->
									<option>ATTENDANT</option>
									<option>ADMINISTRATOR</option>	
					</select><br />
					<button id = "log_in_submit">submit</button>
				</form>
				
				<span id = "error_message"><?php if(isset($error_message)) { echo $error_message; }?></span>
			</div><!-- log_in div -->
		</div>
	</body>
</html>
