<?php
	include("includes/connexion.inc.php");
	include("includes/verif_util.inc.php");
	
	if($connect_util) {
		if($_GET['a']=="del") {
			$sql="DELETE FROM messages WHERE id=:id";
			$prep=$pdo->prepare($sql);
			$prep->bindValue(':id',$_GET['id']);
		}
		else if($_GET['a']=="upd") {
			$sql="UPDATE messages SET contenu=:contenu, date=UNIX_TIMESTAMP() WHERE id=:id";
			$prep=$pdo->prepare($sql);
			$prep->bindValue(':contenu',$_POST['message']);
			$prep->bindValue(':id',$_GET['id']);
		}
		else {
			$sql="INSERT INTO messages(contenu,date) VALUES (:contenu,UNIX_TIMESTAMP())";
			$prep=$pdo->prepare($sql);
			$prep->bindValue(':contenu',$_POST['message']);
		}
		$prep->execute();
	}
	header("location:index.php");
	exit();
?>