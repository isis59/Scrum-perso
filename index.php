<!DOCTYPE>
<?php SESSION_START(); ?>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>jQuery UI Sortable - Portlets</title>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<style>
			body {
			min-width: 520px;
			}
			
			.entete{
			width: 250px;
			padding-bottom: 20px;
			text-align: center;
			}
			
			.column {
			width: 250px;
			min-height: 800px;
			border-right: black solid 1px;
			text-align: center;
			float: left;
			padding-bottom: 100px;
			}
			
			.portlet {
			margin: 10px 1em 0 1em;
			padding: 0.3em;
			}
			
			.portlet-header {
			padding: 0.2em 0.3em;
			margin-bottom: 0.5em;
			position: relative;
			}
			
			.portlet-toggle {
			position: absolute;
			top: 50%;
			right: 0;
			margin-top: -8px;
			}
			
			.portlet-content {
			padding: 0.4em;
			}
			
			.portlet-placeholder {
			border: 1px dotted black;
			margin: 0 1em 1em 0;
			height: 50px;
			}
			
		</style>
		
		<script src="scrum.js"></script>
	</head>
	<body>
		
		<?php
			if(isset($_SESSION['id']) ){
				
				include("db.php");
				try{
					$res_adm = $db->query("select * from config where id='admin'");
					//echo "admin : ".$res_adm->fetch()['value'];
					//if($_SESSION['id'] == $res_adm['value']){
					if(isset($_SESSION['is_admin'])){
						$scrum = "select * from users 
						inner join 
						taches on dev_tache=id_user";
						}else{
						$scrum = "select * from users ";
						//inner join 
						//taches on dev_tache=id_user
						//where users.id_user=".$_SESSION['id_user']
					}
					
					$db->query($scrum);
					
					
				?>
				
				<p style="margin:auto;text-align:center;font-size: 40px">Projet MADERA</p>
				<table>
					<tr>
						<td class="entete">col0</td>
						<td class="entete">col1</td>
						<td class="entete">col2</td>
					</tr>
				</table>
				<div class="column" id="col0" id_col="0" >
					
					<div class='portlet' id='new' id_tache="" id_dev="" id_test="">
						<div class='portlet-header'>Nouvelle tache</div>
						<div class='portlet-content'></div>
					</div>
					
				</div>
				
				<?php
					$sdl="\n";
					$tab="\t";
					//include("db.php");
					
					$sql_colonnes = 'select * from colonnes';
					$req_colonnes = $db->query($sql_colonnes);
					while($res_colonnes = $req_colonnes->fetch()){
						
						echo $tab.'<div class="column" id="col'.$res_colonnes['id_col'].'" id_col="'.$res_colonnes['id_col'].'" >';
						$sql_taches = "select * from taches where col_tache = '".$res_colonnes['id_col']."';";
						$req_taches = $db->query($sql_taches);
						while($res_taches = $req_taches->fetch()){
							echo $sdl.$tab.$tab.'<div class="portlet" id_tache="'.$res_taches['id_tache'].'" id_dev="'.$res_taches['dev_tache'].'" id_test="'.$res_taches['test_tache'].'">'.$sdl;
							echo $tab.$tab.$tab.'<div class="portlet-header">'.$res_taches['lib_tache'].'</div>'.$sdl;
							echo $tab.$tab.$tab.'<div class="portlet-content">'.$res_taches['com_tache'].'</div>'.$sdl;
							echo $tab.$tab.'</div>'.$sdl;
						}
						
						echo $tab."</div>".$sdl.$sdl;
					}
					
					?>
					<div id="div_tache" style="display:none;" title="creer une tache" >
						
					</div>
					<?php
				}
				catch(Exception $e){
					die('Erreur : '. $e->getMessage());
				}
			}
			else{
				echo "<h1>Titre</h1>";
			?>
			<form id="form_connect" action="">
				<label for="login"><input type="text" id="login_form" /></for>
				<label for="pwd"><input type="password" id="pwd_form" /></for>
				<input type="submit" name="connect_form" value="Connexion" />
			</form>
			
			<?php		
			}
		?>
		
	</body>
</html>