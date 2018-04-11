<?php
$votes=$_GET['votes'];
$id=$_GET['id'];

$votes=$votes+1;

include '../includes/connexion.inc.php';
	$pdo->query("UPDATE messages SET votes=$votes WHERE id=$id");
	header("Location: ../index.php");
	exit;


?>
