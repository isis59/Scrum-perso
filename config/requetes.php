<?php
	include("../db.php");
	
	
	
	if(isset($_POST['req'])){
	
		require('functions.php');
	
		switch ($_POST['req']) {
		
			case "info_tache":
				$result = info_tache($_POST['id'],$db);
				echo $result;
				break;
				
			case "new_tache":
				echo new_tache($db);
				break;
				
			case "connect":
				//echo "test";
				$retour = connect($db,$_POST['login'],$_POST['pwd']);
				echo ($retour);
				break;
		
		}	
	
	}

		

?>