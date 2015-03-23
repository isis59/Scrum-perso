<!DOCTYPE>
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
			
			.column {
			width: 250px;
			min-height: 800px;
			border-left: black solid 1px;
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
		<script>
			$(function() {
				
				var entrant;
				var sortant; 
				var ob;
				
				$(".portlet").on("dblclick",function() {
					$("#div_create").dialog();
					$("#id_tache").val($(this).attr("id_tache"));
					//alert($("#id_tache").attr("value"));
					$("#titre").attr("value",$(this).children(".portlet-header").text());
					$("#comm").attr("value",$(this).children(".portlet-content").text());
					$("#couleur").attr("value",$(this).children(".portlet-content").css("background-color"));
					
				});
				
				function maj_tache(tache){
					
						tache.children(".portlet-header").text($("#titre").attr("value"));
						tache.children(".portlet-content").text($("#comm").attr("value"));
					
					}
				
				$("#form_create").on("submit",function(){
				
					
					var html = $.ajax({ type: "GET", url:"maj.php",async: false,data: 'id_tache='+$("#id_tache").val()+'&titre='+$("#titre").val()+'&comm='+$("#comm").val()+'&couleur='+$("#couleur").val()}).responseText;
					alert(html);
					return false;
				});
				
				
				$( ".column" ).sortable({
					connectWith: ".column",
					handle: ".portlet-header",
					cancel: ".portlet-toggle",
					placeholder: "portlet-placeholder ui-corner-all",
					receive: function( event, ui ) {
						entrant = $(this).attr("id_col");
						ob = $(ui.item).attr("id_tache");
					},
					remove: function( event, ui ) {
						sortant = $(this).attr("id_col");
					},
					stop: function( event, ui ) {
						alert("entrant : "+entrant+"\n sortant = "+sortant+"\n objet : "+ob);
						var html = $.ajax({type: "GET", url:"maj.php",async:false,data: 'a=move&id_tache='+ob+'&col='+entrant}).response();
						alert(html);
					}
				});
				
				
				
				$( ".portlet" )
				.addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
				.find( ".portlet-header" )
				.addClass( "ui-widget-header ui-corner-all" )
				.prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
				
				
				
				$( ".portlet-toggle" ).click(function() {
					var icon = $( this );
					icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
					icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
				});
				
				
			});
		</script>
	</head>
	<body>
	<a href="#" id="link_create" />new</a>
	<br /><br /><br /><br />
	
	<?php
		
		include("db.php");
		
		$sql_colonnes = 'select * from colonnes';
		$req_colonnes = $db->query($sql_colonnes);
		while($res_colonnes = $req_colonnes->fetch()){
			
			echo '<div class="column" id_col="'.$res_colonnes['id_col'].'" >'.$res_colonnes['lib_col'].'<br /><br />';
			$sql_taches = "select * from taches where col_tache = '".$res_colonnes['id_col']."';";
			$req_taches = $db->query($sql_taches);
			while($res_taches = $req_taches->fetch()){
				echo '<div class="portlet" id_tache="'.$res_taches['id_tache'].'">';
				echo '<div class="portlet-header">'.$res_taches['lib_tache'].'</div>';
				echo '<div class="portlet-content">'.$res_taches['com_tache'].'</div>';
				echo '</div>';
			}
			
			echo "</div>";
		}
		
	?>
	<div id="div_create" style="display:none;" title="creer une tache" >
		<form id="form_create" method="GET" action="maj.php">
			<input type="hidden" id="id_tache" />
			Titre : <input type="text" id="titre" value=""/><br />
			Commentaire : <input type="text" id="comm" value=""/><br />
			Couleur : <input type="text" id="couleur" value=""/><br /><br />
			<input type="submit" value="envoyer" /><br />
		</form>
	</div>
	
	
</body>
</html>
