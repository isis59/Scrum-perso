<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<link rel="stylesheet" href="styles.css" />
</head>

<div id="entete">
	
	<div class="center left" >
		<img src="http://codigosimples.net/wp-content/uploads/2014/06/28-scrum-600x279.gif" alt="logo-scrum" />
	</div>
	<div class="center right">
		<img src="http://www.inqbation.com/wp-content/uploads/2014/02/github-logo.png" alt="logo-github" />
	</div>
</div>

<div id="intro">
	Bonjour, 
	<br />
	tout d'abord, merci d'avoir téléchargé myscrum. J'espère que celui-ci vous apportera entière satisfaction. <br /><br />
	En cas de questions ou de suggestions, merci de me contacter à [MAIL]. Vous pouvez envoyer vos dons de soutien au projet via PayPal à cette même adresse. 
	
	<br /><br />
	
	Si vous voyez cette page alors que vous avez déjà procédé à l'installation via ces étapes, alors supprimez le répertoire nommé "_install".
	
	<br /><br />
	Merci et bon travail =)
	<br /><br />
	<br /><br />
	
<?php
	
	if(!defined('PHP_VERSION_ID')){
		$version = explode('.',PHP_VERSION);	
		define('PHP_VERSION_ID',($version[0] * 1000 + $version[1] * 100 + $version[2]));
	}
	
	echo PHP_VERSION_ID;
	
	if(!isset($_GET['step'])){

		echo '<form method="POST" action="?step=1" />';
		echo '<input type="submit" value="Commencer l\'installation" />';
		echo '</form>';

	}
	else{
		if($_GET['step'] == 1){

			echo '<br /><br /><br /><br />';
			echo '<form method="POST" action="?step=2" >';
			echo'<label for="name">Nom de la base de données MySQL <input type="text" name="bdd" /></label><br />';
			echo'<label for="account">Utilisateur de la base de données <input type="text" name="account" /></label><br />';
			echo'<label for="password">Mot de passe du compte <input type="password" name="password" /></label><br />';
			echo'<input type="submit" value="Etape suivante" OnClick="$(this).val(\' Connexion à la base en cours ... \')" />';
			echo '</form>';
		}
		else if($_GET['step'] == 2){
			require('_install/db_connect.php');
		}
		else if($_GET['step'] == 3){
			require('_install/config_projet.php');
		
			//array_map('unlink', glob("_install/*"));
			//rmdir('_install');
			echo "<script>alert('installation terminée. Vous pouvez vous connecter avec les identifiants d\'administration');";
			echo "window.location.href='index.php';</script>";
		}
	}

?>	
</div>	


</html>