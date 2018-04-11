<?php
	include("connexion.inc.php");

	if(isset($_COOKIE['sid'])) {
		$connect_util = true;
		$sql="SELECT email FROM utilisateurs WHERE sid=:sid";
		$stmt=$pdo->prepare($sql);
		$stmt->bindValue(':sid',$_COOKIE['sid']);
		$stmt->execute();
		$data=$stmt->fetch();
		$email_util = $data['email'];
	}
	else
		$connect_util = false;
?>