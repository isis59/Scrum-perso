<?php
	
include("db.php");
	
if(isset($_POST['a'])){	
	if($_POST['a'] == "move"){
		$sql_upd = "UPDATE taches set col_tache='".$_POST['col']."' where id_tache=".$_POST['id_tache']."";
		$sql_col = "select * from colonnes where id_col='".$_POST['col']."'";
		$res_col = $db->query($sql_col)->fetch();
		
		if($res = $db->query($sql_upd)){
			//echo $sql_sel;
			//echo $_POST['col'];
			echo "deplacement effectué";
			if($res_col['lib_col'] == "test"){
				echo "envoi en test";
				$sel_task = "select * from taches where id_tache=".$_POST['id_tache'];
				$res_seltask = $db->query($sel_task)->fetch();
				
				$upd_task = "update taches set dev_tache=".$res_seltask['test_tache'].", test_tache=".$res_seltask['dev_tache'].", etat_tache='test', col_tache=1 where id_tache=".$_POST['id_tache'];	
				$res_updtask = $db->query($upd_task);
			}
			
				
			
		}
		else{
			echo $sql_upd;
		}
	}
	else if($_POST['a'] == "edit"){
		$sql = "UPDATE taches SET lib_tache='".$_POST['titre']."', com_tache='".$_POST['comm']."', dev_tache='".$_POST['dev']."', test_tache='".$_POST['test']."', couleur_tache='".$_POST['couleur']."' where id_tache='".$_POST['id_tache']."'";
		$res = $db->query($sql);
		echo "tache ".$_POST['id_tache']." mise à jour";
	}
	else if($_POST['a'] == "new"){
		$sql = "INSERT INTO taches values(
			'', 
			'".$_POST['titre']."', 
			'".$_POST['comm']."', 
			'".$_POST['dev']."', 
			'".$_POST['test']."',
			'1',
			'".$_POST['couleur']."'
		)";
		
		$res = $db->query($sql);
		
		echo "tache créée";
	}
}
else{
	echo "erreur de paramètre";
}

?>