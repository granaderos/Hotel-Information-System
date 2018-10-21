<?php
		
	include 'DAO/DictionaryDAO.php';


	$search= $_POST['search'];

	
	$action = new DictionaryDAO();	
	$action->searchWord($search);

?>
