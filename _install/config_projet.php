<?php
	require_once('config/db.inc.php');
	
	$id_cdp=rand(1,10);
	$db->query('insert into config values("nom_projet","'.$_POST['nom_projet'].'")');
	$db->query('insert into users values('.$id_cdp.',"'.$_POST['nom_cdp'].'","'.$_POST['login_cdp'].'","'.password_hash($_POST['password_cdp']).'","'.$_POST['mail_cdp'].'" )');
	
	$db->query('insert into config values("admin","'.$id_cdp.'")');
	
?>