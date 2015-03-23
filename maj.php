<?php
	
	include("db.php");
	
	$sql = "UPDATE taches SET lib_tache='".$_GET['titre']."' where id_tache='".$_GET['id']."'";
	$res = $db->query($sql);
	
	echo $sql;
?>