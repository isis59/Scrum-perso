<?php
	
include("db.php");
	
if(isset($_GET['a'])){	
	if($_GET['a'] == "move"){
		$sql_upd = "UPDATE taches set col_tache='".$_GET['col']."' where id_tache=".$_GET['id_tache']."";
		$sql_col = "select * from colonnes where id_col='".$_GET['col']."'";
		$res_col = $db->query($sql_col)->fetch();
		
		if($res = $db->query($sql_upd)){
			//echo "deplacement effectué";
			//echo $sql_sel;
			//echo $_GET['col'];
			if($res_col['lib_col'] == "test"){
				echo "test";
				$sel_task = "select * from taches where id_tache=".$_GET['id_tache'];
				$res_seltask = $db->query($sel_task)->fetch();
				
				$upd_task = "update taches set lib_tache='[TEST]".$res_seltask['lib_tache']."', dev_tache=".$res_seltask['test_tache'].", test_tache=".$res_seltask['dev_tache'].", com_tache='[A tester] ".$res_seltask['com_tache']."', col_tache=1 where id_tache=".$_GET['id_tache'];	
				$res_updtask = $db->query($upd_task);
			}
			
				
			
		}
		else{
			echo $sql_sel;
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