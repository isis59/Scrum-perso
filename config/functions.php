<?php	
	function info_tache($id,$bd){
		$req_infotache = $bd->query("select * from taches where id_tache = ".$id);
		$res_infotache = $req_infotache->fetch();
		$form = "<form id=\"form_tache\" method=\"GET\"><input type=\"hidden\" id=\"id_tache\" name=\"test\" value=\"".$id." \" />
		Titre : <input type=\"text\" id=\"titre\" value=\"".$res_infotache['lib_tache']."\"/><br />
		Commentaire : <input type=\"text\" id=\"comm\" value=\"".$res_infotache['com_tache']."\"/><br />
		Developpeur : <br /><select name=\"dev\" id=\"dev\">";
		
		$req= $bd->query("select * from users");
		while($res= $req->fetch()){
			$form .= "<option value=".$res['id_user'];
			if($res_infotache['dev_tache'] == $res['id_user']){ $form .=  " selected";};
			$form .= ">".$res['nom_user']."</option>";
		}
		
		$form .= '</select><br />Testeur : <br /><select name="test" id="test">';
		
		$req= $bd->query("select * from users");
		while($res= $req->fetch()){
			$form .= "<option value=".$res['id_user'];
			if($res_infotache['test_tache'] == $res['id_user']){ $form .=  " selected";};
			$form .= ">".$res['nom_user']."</option>";
		}
		
		$form .= '</select><br />
		Couleur : <input type="color" id="couleur" value="#'.$res_infotache['couleur_tache'].'"/><br /><br />
		<input type="submit" value="envoyer" /><br />
		</form>';
		
		return $form;
	}
	
	function new_tache($bd){
	
		$req_insert = $bd->query("insert into taches values('',' ',' ',1,1,1,'ff0000','new')");
		$test =$bd->lastInsertId();
	
		$req_newid = $bd->query("select max(id_tache) as id from taches");
		$res_newid = $req_newid->fetch();
		
		$form_new = info_tache($test,$bd);
		
		return $form_new;
	
	}
?>