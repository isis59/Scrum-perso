<?php
	
	include("db.php");
	if($_GET['a'] == "move"){
		$sql = "UPDATE taches set col_tache='".$_GET['col']."' where id_tache='".$_GET['id_tache']."'";
		$res = $db->query($sql);
		}
	else{
		$sql = "UPDATE taches SET lib_tache='".$_GET['titre']."', com_tache='".$_GET['comm']."', couleur_tache='".$_GET['couleur']."' where id_tache='".$_GET['id_tache']."'";
		$res = $db->query($sql);
	}
	echo $sql;
?>