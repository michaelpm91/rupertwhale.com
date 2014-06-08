<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	$db = db_con('pdo','rupertwhale');

	if($_POST['action']=='deleteproject'){
		$id = $_POST['id'];
		$stmt = $db->prepare("DELETE FROM project WHERE id=:id");
		$stmt->bindParam(':id', $id);
		
		$stmt->execute();


		$stmt = $db->prepare("SELECT * FROM projectOrder WHERE id='1'");
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		$order = json_decode($result['projectOrder']);
		//print_r($order);
		
		/*if (($key = array_search($id, $order)) !== false) {
			unset($order[$key]);
		}*/
		$order = array_diff($order, array($id));
		//print_r($order);

		$stmt = $db->prepare("UPDATE projectOrder SET projectOrder=:order WHERE id='1'");
		$stmt->bindParam(':order', json_encode($order));	
		$stmt->execute();

		/*if (($key = array_search('strawberry', $array)) !== false) {
			unset($array[$key]);
		}*/

	}