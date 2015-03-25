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
		if($(this).attr("id_tache") != ""){
			var html_form = $.ajax({
				type: "GET",
				url: "config/requetes.php",
				async: false,
				data: 'req=info_tache&id='+$(this).attr("id_tache")
			}).responseText;
			
			alert(html_form);
			$("#div_tache").html(html_form);
			$("#div_tache").dialog();
			
			$( document ).delegate("#form_tache", "submit", function(){
				
				alert('id : '+($("#id_tache").val()));
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
					alert("ok");
				}
				else{
					//alert ($("#id_tache").val());
					var html = tache_edit($("#id_tache").val(),$("#titre").val(),$("#comm").val(),$("#dev").val(),$("#test").val(),$("#couleur").val());
					alert("nok");
				}
				
				if(DEBUG){
					alert(html);
				}
				
				$("#div_tache").dialog("close");
				
				return false;
			}); 
			
			
		}else{
			alert('else');
		}
	});
	
	$("#form_tache").on("submit",function(){
		
		alert('id : '+($("#id_tache").val()));
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
			
			if(DEBUG){
				alert("dans 'if id_tache est vide' du form_tache_submit ");
			}
		}
		else{
			//alert ($("#id_tache").val());
			var html = tache_edit($("#id_tache").val(),$("#titre").val(),$("#comm").val(),$("#dev").val(),$("#test").val(),$("#couleur").val());
			if(DEBUG){
				alert("dans else du 'if id_tache est vide' du form_tache_submit ");
			}
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
			if(html == "test"){
				alert('passage en test');
				//location.reload(true);
			}
			if(1){
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