<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		header("Location: admin.php?loc=arrangeproject");
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';
	$db = db_con('pdo','rupertwhale');
	
	$stmt = $db->prepare("SELECT * FROM project");
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$project = '';
	if (!empty($result)){
		
		$stmt1 = $db->prepare("SELECT * FROM projectOrder WHERE id='1'");
		$stmt1->execute();
		$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

		$order = json_decode($result1['projectOrder']);

		usort($result, function ($a, $b) use ($order) {
			$pos_a = array_search($a['id'], $order);
			$pos_b = array_search($b['id'], $order);
			return $pos_a - $pos_b;
		});

		foreach($result as $item){
			$title =$item['title'];
			
			if(strlen($item['title'])>25){
				$title = substr($item['title'],0,25)."...";
			}			
			$project .= '
			<li style="position:relative;" id="'.$item['id'].'" class="preview ui-state-default">
				<div class="descriptionText" style="display: none;"></div>
				<img width="100%" height="100%" id="theImg" src="/uploads/'.$item['coverImage'].'">
				<div style="bottom:0;width:100%;font-size:12px;position:absolute;background-color:black;color:white;">'.$item['title'].'</div>
			</li>';
		}
	}else{
		$project = "No projects available";
	}

	$script = "
		<link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css' />
		<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js'></script>
		<script type='text/javascript' src='/scripts/arrangeproject.js'></script>
		<style>
			#content{ margin-top:30px;}
			#sortable { overflow:auto; background-color:white; list-style-type: none; margin: 0; padding: 0; width: 800px; min-height: 500px; }
			#sortable li { position:relative; margin: 1% 1%; width: 31%; height:180px; float:left; padding:0; font-size: 4em; text-align: center; }
			#updateOrder{
				color: black;
				font-size: 22px;
				position: absolute;
				top: 0;
				right: 15px;
			}
		</style>
	";
?>
<!DOCTYPE html>
<html>
	<?=documentHead("Edit Project - $projectTitle",$script)?>
	<body>
		<?=adminHeader()?>
		<div id='content'>
			<div><h1>Arrange Projects</h1><input id='updateOrder' value='Update' type='button'></div>
			<div style='text-align:center;'></div>
			<ul id="sortable">
				<?=$project?>
			</ul>
		</div>
	</body>

</html>