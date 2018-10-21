<?php

   class BaseDAO{


         protected $user = "root";
         protected $pass= "";
         protected $db_name="Dictionary";
         protected $dbh = null;
        
        function open(){
        
        $this->dbh =new PDO("mysql:host=localhost;dbname=".$this->db_name,$this->user,$this->pass);
        
        }
        function close(){
        
          $this ->dbh=null;
        }
        
        
        
        }

?>
