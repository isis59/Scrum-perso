<?php	
	function info_tache($id,$bd){
		$req_infotache = $bd->query("select * from taches where id_tache = ".$id);
		$res_infotache = $req_infotache->fetch();
		$form = "<form id=\"form_tache\" method=\"POST\"><input type=\"hidden\" id=\"id_tache\" name=\"test\" value=\"".$id." \" />
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
		<input type="button" id="delete" value="Supprimer" /><br />
		<input type="submit" value="envoyer" /><br />
		</form>';
		
		
		return $form;
	}
	
	function new_tache($bd){
	
		//$req_admin = $bd->query("select * from config where id_config = 'admin' ");
		//$res_admin = $req_admin->fetch();
		$sql = "insert into taches values('','titre tache','commentaire',NULL,NULL,1,'c0c0c0','a_faire')";
		$req_insert = $bd->query($sql);
		$test =$bd->lastInsertId();
	
		$form_new = info_tache($test,$bd);
		return $form_new;
	
	}
	
	function del_tache($bd,$id){
		try{
			$req_delete = $bd->query("delete from taches where id_tache = '".$id."'");
			echo "success";
		}
		catch(Exception $e){
			die('Erreur : '. $e->getMessage());
		}
	}
	
	function connect($bd,$login, $mdp){
		$sql = "SELECT * FROM users left join config on id_user = value_config where login_user = '".$login."'";
		//return $sql;
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		$req_connect = $bd->query($sql);
		if($res_connect = $req_connect->fetch()){
			if(password_verify($mdp,$res_connect['passwd_user'])){
				session_start();
				$_SESSION['id_user'] = $res_connect['id_user'];
				if($res_connect['id_config'] == "admin"){
					$_SESSION['is_admin'] = true;
				}
				
				session_write_close();
				$retour="ok";
			}
			else{
				$retour = "Connexion échouée. Vérifiez vos identifiants";
			}
		}
		else{
			$retour = "Connexion échouée. Vérifiez vos identifiants inexistant";
		}
			
		
		return $retour;
	
	}
?>