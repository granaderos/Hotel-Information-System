<?php
	
	$id = $_POST['id'];
	include 'DAO/DictionaryDAO.php';
	
	$action = new DictionaryDAO();	
	$action->retrieve($id);

?>
