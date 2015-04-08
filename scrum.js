$(function() {
	
	var DEBUG=false;
	
	var entrant;
	var sortant; 
	var ob;
	
	function tache_move(tache, destination){
		return ($.ajax({
			type: "POST", 
			url:"maj.php",
			async:false,
			data: 'a=move&id_tache='+tache+'&col='+destination
		}).responseText);
	}
	
	function tache_edit(tache,titre, comm, dev, test, couleur ){
		return ($.ajax({ 
			type: "POST", 
			url:"maj.php",
			async: false,
			data: 'a=edit&id_tache='+tache+'&titre='+titre+'&comm='+comm+'&dev='+dev+'&test='+test+'&couleur='+couleur
		}).responseText);	
	}
	

	
	$(".portlet").on("dblclick",function() {
		
		var tache = $(this);
		$("#id_tache").val("");	
		
		if(DEBUG){
			alert("L35 : event portlet : dblclick \n\n id_tache = "+$(this).attr("id_tache"));
		}
		
		if($(this).attr("id_tache") != "" && $(this).attr("id") != "new"){
		
			var html_form = $.ajax({
				type: "POST",
				url: "config/requetes.php",
				async: false,
				data: 'req=info_tache&id='+$(this).attr("id_tache")
			}).responseText;
			
			if(DEBUG){
				alert("L48 : .portlet on dblckick {scrum.js} & id_tache !='' \n\n"+html_form);
			}
			
			$("#div_tache").html(html_form);
			$("#div_tache").dialog();
			
			$( document ).delegate("#form_tache", "submit", function(){
				
				var html = tache_edit($("#id_tache").val(),$("#titre").val(),$("#comm").val(),$("#dev").val(),$("#test").val(),($("#couleur").val()).substring(1,7));
				
				if(DEBUG){
					alert("modif ok");
					alert(html);
				}
				
				$("#div_tache").dialog('close');
				
				return false;
			}); 
		}
		else{
			$(this).attr("id_tache","");
			if(DEBUG){
				alert('L72 : $(this).attr("id_tache") != "" || $(this).attr("id_tache") != "0"');
				alert("L73 : .portel on dblckick {scrum.js} & id_tache !='' \n\n else l:77");
			}
			
			var html_form = $.ajax({
				type: "POST",
				url: "config/requetes.php",
				async: false,
				data: 'req=new_tache'
				}).responseText;
			
			if(DEBUG){
				alert(html_form);
			}
			
			$("#div_tache").html(html_form);
			$("#div_tache").dialog();
			
			
			$( document ).delegate("#form_tache", "submit", function(){
				
				var html = tache_edit($("#id_tache").val(),$("#titre").val(),$("#comm").val(),$("#dev").val(),$("#test").val(),($("#couleur").val()).substring(1,7));
				
				if(DEBUG){
					alert(html);
				}

				var tache_new = "<div class='portlet' id='' id_tache='"+$("#id_tache").val()+"' id_dev='"+$("#dev").val()+"' id_test='"+$("#test").val()+"'><div class='portlet-header'>"+$("#titre").val()+"</div><div class='portlet-content'>"+$("#comm").val()+"</div></div>";						
				
				$("#col1").append(tache_new);
				
				$( ".portlet" )
				.addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
				.find( ".portlet-header" )
				.addClass( "ui-widget-header ui-corner-all" )
				.prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
				
				$("#div_tache").dialog("close");
				$( document ).undelegate("#form_tache", "submit");
				$("#form_tache").remove();
						
				return false;
			}); 
			
			$("#col0").sortable( "cancel" );
			
		}
		
		$( document ).delegate("#delete", "click", function( event, ui){
				
			var html = $.ajax({
				type: "POST",
				url: "config/requetes.php",
				async: false,
				data: 'req=del_tache&id='+$("#id_tache").val()
				}).responseText;
	
			if(html == "success" && tache.attr("id_tache") != "0"){
				tache.remove();
			}else{
				if(tache.attr("id_tache") != "0"){
					alert(html);
				}
			}
			
			$("#div_tache").dialog("close");
			$( document ).undelegate("#delete", "click");
			$("#form_tache").remove();
			
			return false;
		});
		
				
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
			if(DEBUG){
				alert($(ui.item).attr("id_tache"));
			}
			
			if($(ui.item).attr("id_tache") != ""){
				var html = tache_move(ob,entrant);
				if(html == "test"){
					alert('Envoi en test');
					//location.reload(true);
				}
			}
			if(DEBUG){
					alert("move_tache \n\nentrant : "+entrant+"\n sortant = "+sortant+"\n objet : "+ob);
					alert(html);
				}
		}
	});
	
	
	$("#col0").sortable({
		remove: function(event, ui){
			$(ui.item).dblclick();
		}
	});
	
	
	$( ".portlet" )
	.addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
	.find( ".portlet-header" )
	.addClass( "ui-widget-header ui-corner-all" )
	.prepend( "<span class='ui-icon ui-icon-plusthick portlet-toggle'></span>");
	
	
	$( ".portlet-toggle" ).click(function() {
		var icon = $( this );
		icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
		icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
	});
	
	$("#form_connect").on("submit",function(){
		var retour = $.ajax({
				type: "POST",
				url: "config/requetes.php",
				async: false,
				data: 'req=connect&login=' +$("#login_form").val() + '&pwd='+$("#pwd_form").val()
				}).responseText;
	
		if(retour == "ok"){
			return true;
		}
		else{
			alert(retour);
			return false;
		}
		
	});
	
});