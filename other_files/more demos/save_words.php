<?php
		
	include 'DAO/DictionaryDAO.php';

	$id = $_POST['id'];
	$word = $_POST['word'];
	$definition = $_POST['definition'];

	
	$action = new DictionaryDAO();	
	$action->save($id, $word, $definition);

?>
