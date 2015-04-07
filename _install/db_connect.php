<?php
	try{
		$db = new PDO('mysql:host=localhost;dbname='.$_POST['bdd'].';charset=utf8',$_POST['account'],$_POST['password']);

		echo "Connexion réussie";
		
		
		// creation du dossier de configuration
		if(!is_dir("config")){
			mkdir("config");
		}

		// creation du fichier de connexion de la bdd

		//$fichier = fopen('config/db.inc.php', 'a+');
		$fill = '	
<?php 
	try{
		$db = new PDO(\'mysql:host=localhost;dbname='.$_POST['bdd'].";charset=utf8','".$_POST['account']."','".$_POST['password']."');		
	}
	catch(Exception".' $e){
		die(\'Erreur : \'. $e->getMessage());
	}
?>';
		//fputs($fichier, $fill);
		//fclose($fichier);
		file_put_contents ('config/db.inc.php',$fill);
		
		//creation des tables de la bdd
		if(file_exists('_install/structure2.sql')){
			$db->query(file_get_contents('_install/structure2.sql'));	
		}	
		
		echo '<form method="POST" action="?step=3" >';
		echo'<label for="nom_projet">Nom du projet* : <input type="text" name="nom_projet" required/></label><br />';
		echo'<label for="nom_cdp">Nom du chef de projet* : <input type="text" name="nom_cdp" required/></label><br />';
		echo'<label for="login_cdp">Login* : <input type="text" name="login_cdp" required/></label><br />';
		echo'<label for="password_cdp">Mot de passe du compte* : <input type="password" name="password_cdp" required /></label><br />';
		echo'<label for="mail_cdp">Mail* : <input type="mail" name="mail_cdp" required /></label><br />';
		echo'<input type="submit" value="Etape suivante" />';
		echo '</form>';
	}
	catch(Exception $e){
		die('Erreur : '. $e->getMessage());
	}
?>