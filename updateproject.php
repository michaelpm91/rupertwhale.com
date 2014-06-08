<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	$db = db_con('pdo','rupertwhale');

	if($_POST['action']=='updateproject'){
	
		$imageArray = json_encode($_POST['images']);
		
		$stmt = $db->prepare("UPDATE project SET title=:title,imageData=:imageData,coverImage=:coverImage WHERE id=:id");
		$stmt->bindParam(':id', $_POST['projectID']);
		$stmt->bindParam(':title', $_POST['title']);
		$stmt->bindParam(':imageData', $imageArray);
		$stmt->bindParam(':coverImage', $_POST['images'][0]['thumbnail']);
		
		$stmt->execute();

	}