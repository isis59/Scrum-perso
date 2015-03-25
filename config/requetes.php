<?php
	include("../db.php");
	
	
	
	if(isset($_GET['req'])){
	
		require('functions.php');
	
		switch ($_GET['req']) {
		
			case "info_tache":
				$result = info_tache($_GET['id'],$db);
				echo $result;
				break;
		
		}	
	
	}

		

?>