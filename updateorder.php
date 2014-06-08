<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';

	$db = db_con('pdo','rupertwhale');

	if($_POST['action']=='updateorder'){
		$newOrder = $_POST['newOrder'];
		$stmt = $db->prepare("UPDATE projectOrder SET projectOrder=:order WHERE id='1'");
		$stmt->bindParam(':order', json_encode($newOrder));	
		$stmt->execute();

	}