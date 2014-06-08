<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	$db = db_con('pdo','rupertwhale');

	if($_POST['action']=='updateAbout'){
		$stmt = $db->prepare("UPDATE user SET aboutInfo=:value WHERE username='rupert'");
		$stmt->bindParam(':value', $_POST['editData']);

		$stmt->execute();

	}