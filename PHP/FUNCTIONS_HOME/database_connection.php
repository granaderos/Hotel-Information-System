<?php
	
	class Database_connection {
		
      protected $dbh;
      
      function open_connection(){
         $this->dbh = new PDO("mysql:host=localhost;dbname=hotel_information_system", "root", "");
      }
      function close_connection(){
         $this->dbh = null;
      }
      
	}
?>
