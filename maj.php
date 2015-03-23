<?php
	
	include("db.php");
if(isset($_GET['a'])){	
	if($_GET['a'] == "move"){
		$sql = "UPDATE taches set col_tache='".$_GET['col']."' where id_tache='".$_GET['id_tache']."'";
		if($res = $db->query($sql)){
			echo "deplacement effectué";
		}
		else{
			echo $sqll;
		}
	}
	else if($_GET['a'] == "edit"){
		$sql = "UPDATE taches SET lib_tache='".$_GET['titre']."', com_tache='".$_GET['comm']."', dev_tache='".$_GET['dev']."', test_tache='".$_GET['test']."', couleur_tache='".$_GET['couleur']."' where id_tache='".$_GET['id_tache']."'";
		$res = $db->query($sql);
		echo $sql;
	}
	else if($_GET['a'] == "new"){
		$sql = "INSERT INTO taches values(
			'', 
			'".$_GET['titre']."', 
			'".$_GET['comm']."', 
			'".$_GET['dev']."', 
			'".$_GET['test']."',
			'1',
			'".$_GET['couleur']."'
		)";
		
		$res = $db->query($sql);
		
		echo "tache créée";
	}
}
else{
	echo "erreur de paramètre";
}

?>