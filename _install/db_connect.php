<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname='.$_POST['bdd'].';charset=utf8',$_POST['account'],$_POST['password']);
		echo "Connexion réussie";
		
		require('db_create.php');
		
	}
	catch(Exception $e){
		die('Erreur : '. $e->getMessage());
	}
?>