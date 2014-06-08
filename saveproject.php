<?php
	session_start();
	include_once '/home/kidshenlong/Private/login.php';
	$db = db_con('pdo','rupertwhale');

	if($_POST['action']=='saveproject'){



		echo $_POST['title'];
		print_r($_POST['images']);
		$imageArray = json_encode($_POST['images']);

		$stmt = $db->prepare("INSERT INTO project (title,imageData,coverImage) VALUES (:value1,:value2,:value3)");

		//$stmt->bindParam(':value', $_GET['id']);

		$stmt->execute(array(':value1' => $_POST['title'], ':value2'=> $imageArray,':value3'=> $_POST['images'][0]['thumbnail']));

		$newID = $db->lastInsertId();

		$stmt = $db->prepare("SELECT * FROM projectOrder WHERE id='1'");
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$order = json_decode($result['projectOrder']);
		array_push($order, $newID);

		$stmt = $db->prepare("UPDATE projectOrder SET projectOrder=:order WHERE id='1'");
		$stmt->bindParam(':order', json_encode($order));	
		$stmt->execute();

	}