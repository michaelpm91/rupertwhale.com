<?php
	session_start();
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';
	
	$db = db_con('pdo','rupertwhale');
		
	$stmt = $db->prepare("SELECT * FROM user WHERE username=:username AND password = PASSWORD(:password)");
	$stmt->bindParam(':username', $_POST['userName']);
	$stmt->bindParam(':password', $_POST['password']);
	$stmt->execute();
	$result = $stmt->fetch();
	if (!empty($result)){		
		echo $arr = json_encode(array('login'=>TRUE));
		$_SESSION['loggedIn']=TRUE;

	}else{
		echo $arr = json_encode(array('login'=>FALSE));
	}