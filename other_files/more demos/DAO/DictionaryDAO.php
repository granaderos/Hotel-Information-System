<?php
        include 'BaseDAO.php';
        class DictionaryDAO extends BaseDAO{
       

                function viewWords(){
                $this->open();
                $stmt=$this->dbh->prepare("SELECT * FROM words");
                
                $stmt->execute();
                    $this->close();
                     
                while ($row=$stmt->fetch()){
                 echo "<tr id=".$row[0].">";
                 echo "<td>".$row[0]."</td>";
                 echo "<td>".$row[1]."</td>";
                 echo "<td>".$row[2]."</td>";
                 echo "<td><img class='delete' src='image.php/Actions-window-close-icon.png' onclick= 'deleteWords(".$row[0].")'/>";
                 echo "<img src='image.php/Edit-Document-icon.png' onclick= 'editWords(".$row[0].")'/></td>";
				echo "</tr>";
    }
                  
               
                     
        }
        
        function addWords($word,$definition){
       
        $this->open();
        
        $stmt =$this->dbh->prepare("INSERT INTO words(word, definition) values (?, ?)");
        $stmt ->bindParam(1, $word);
        $stmt ->bindParam(2, $definition);
        $stmt->execute();
        $id=$this->dbh->lastInsertId();
           $this->close();
          echo "<tr id=".$id.">";
         echo "<td>".$id."</td>";
          echo "<td>".$word."</td>";
          echo "<td>".$definition."</td>";
           echo "<td><img class='delete' src='image.php/Actions-window-close-icon.png' onclick= 'deleteWords(".$id.")'/>";
                 echo "<img src='image.php/Edit-Document-icon.png' onclick= 'editWords(".$id.")'/></td>";
			echo "</tr>";
                  
          }
       	function deleteWords($id){
			
			$this->open();

			$stmt = $this->dbh->prepare("DELETE FROM words WHERE id = ?");
			$stmt->bindParam(1, $id);
			$stmt->execute();
	
			$this->close();	
		}

      	function save($id, $word, $definition){
			$this->open();
			
			$stmt = $this->dbh->prepare("UPDATE words SET word = ?, definition = ? WHERE id = ?");
			$stmt->bindParam(1, $word);
			$stmt->bindParam(2, $definition);
			$stmt->bindParam(3, $id);			
			$stmt->execute();

                           $this->close();
			echo "<td>".$id."</td>";
			echo "<td>".$word."</td>";
			echo "<td>".$definition."</td>";
                           echo "<td ><img class='delete'src='image.php/Actions-window-close-icon.png' onclick= 'deleteWords(".$id.")'/>";
                           echo "<img src='image.php/Edit-Document-icon.png' onclick= 'editWords(".$id.")'/></td>";

		}
			function retrieve($id){
			$this->open();
			
			$stmt = $this->dbh->prepare("SELECT * FROM words WHERE id = ?");
			$stmt->bindParam(1, $id);
			$stmt->execute();

			$record = $stmt->fetch();
			
			$words = array("id"=>$record[0],"word"=>$record[1], "definition"=>$record[2]);

			$json_string = json_encode($words);
			
			echo $json_string;	

		
			$this->close();
		}
		function searchWord($word){
			$this->open();
			
			$stmt = $this->dbh->prepare("select * from words where word = ?");
			
			$stmt->bindParam(1, $word);
						
			$stmt->execute();
                           $row=$stmt->fetch();
                           echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
                           echo "<td ><img class='delete'src='image.php/Actions-window-close-icon.png' onclick= 'deleteWords(".$row[0].")'/>";
                           echo "<img src='image.php/Edit-Document-icon.png' onclick= 'editWords(".$row[0].")'/></td>";
                           $this->close();
		}
		function logIn($username,$password){
      	
      		$this->open();
      		
		   		$stmt = $this->dbh->prepare("SELECT * FROM logIn");
		   		$stmt->execute();
		   		
		   		while($row = $stmt->fetch()){
		   			if($row[0]==$username && $row[1] == $password){
		   				return true;
		   			}else{
		   				return false;
		   			}
		   		}	
													
														
      		$this->close();
      }
      }
  


?>
