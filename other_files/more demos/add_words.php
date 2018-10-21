<?php
         include 'DAO/DictionaryDAO.php';
         
      
        $word=$_POST['word'];
        $definition=$_POST['definition'];
        
        
        $action = new DictionaryDAO();
        $action->addWords($word,$definition);

     
     
?>

