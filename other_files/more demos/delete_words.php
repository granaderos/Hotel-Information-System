<?php
	
	include 'DAO/DictionaryDAO.php';

	$id = $_POST['id'];
	
	$action = new DictionaryDAO();
	$action->deleteWords($id);

?>
