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
		<script>
			$(function() {
				
				var DEBUG=false;
				
				var entrant;
				var sortant; 
				var ob;
				
				function tache_move(tache, destination){
					return ($.ajax({
						type: "GET", 
						url:"maj.php",
						async:false,
						data: 'a=move&id_tache='+tache+'&col='+destination
					}).responseText);
				}
				
				function tache_edit(tache,titre, comm, dev, test, couleur ){
					return ($.ajax({ 
						type: "GET", 
						url:"maj.php",
						async: false,
						data: 'a=edit&id_tache='+tache+'&titre='+titre+'&comm='+comm+'&dev='+dev+'&test='+test+'&couleur='+couleur
					}).responseText);	
				}
				
				function tache_create(titre,comm,dev,test,couleur){
					return ($.ajax({
						type: "GET",
						url: "maj.php",
						async: false,
						data: 'a=new&titre='+titre+'&comm='+comm+'&dev='+dev+'&test='+test+'&couleur='+couleur
					}).responseText);
				}
				
				$(".portlet").on("dblclick",function() {
					// vidage du champs id_tache 
					$("#id_tache").val("");					
					$("#div_tache").dialog();
					
					$("#id_tache").val($(this).attr("id_tache"));
					$("#titre").attr("value",$(this).children(".portlet-header").text());
					$("#comm").attr("value",$(this).children(".portlet-content").text());
					$("#dev").attr("value",$(this).attr("id_dev"));
					$("#test").attr("value",$(this).attr("id_test"));
					$("#couleur").attr("value",$(this).children(".portlet-content").css("background-color"));
					
				});
				
				$("#link_create").click(function(){
					// vidage du champs id_tache 
					$("#id_tache").val("");
					$("#div_tache").dialog();
					
				});
				
				
				$("#form_tache").on("submit",function(){
					if($("#id_tache").val() == ""){
						var html = tache_create($("#titre").val(),$("#comm").val(),$("#dev").val(),$("#test").val(),$("#couleur").val());
						var tache_new = "<div class='portlet' id='' id_tache='' id_dev='"+$("#dev").val()+"' id_test='"+$("#test").val()+"'><div class='portlet-header'>"+$("#titre").val()+"</div><div class='portlet-content'>"+$("#comm").val()+"</div></div>";						
						
						$("#col1").append(tache_new);
						
						$( ".portlet" )
						.addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
						.find( ".portlet-header" )
						.addClass( "ui-widget-header ui-corner-all" )
						.prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
						
						$("#col0").sortable( "cancel" );
					}
					else{
						//alert ($("#id_tache").val());
						var html = tache_edit($("#id_tache").val(),$("#titre").val(),$("#comm").val(),$("#dev").val(),$("#test").val(),$("#couleur").val());
					}
					
					if(DEBUG){
						alert(html);
					}
					
					$("#div_tache").dialog("close");
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
						var html = tache_move(ob,entrant);
						if(DEBUG){
							alert("entrant : "+entrant+"\n sortant = "+sortant+"\n objet : "+ob);
							alert(html);
						}
					}
				});
				
				
				$("#col0").sortable({
					remove: function(event, ui){
						$("#div_tache").dialog();
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
		include("db.php");
		
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
		<form id="form_tache" method="GET" action="maj.php">
			<input type="hidden" id="id_tache" />
			Titre : <input type="text" id="titre" value=""/><br />
			Commentaire : <input type="text" id="comm" value=""/><br />
			Developpeur : <input type="text" id="dev" value=""/><br />
			Testeur : <input type="text" id="test" value=""/><br />
			Couleur : <input type="text" id="couleur" value=""/><br /><br />
			<input type="submit" value="envoyer" /><br />
		</form>
	</div>
	
	
</body>
</html>
