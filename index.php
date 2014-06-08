<?php
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';

	$db = db_con('pdo','rupertwhale');
	//SELECT project, location FROM images GROUP BY LOWER(project)
	
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
			$project .= "<a href='project/".$item['id']."'><div class='project'><img src='/uploads/".$item['coverImage']."'/><h3>".$title."</h3></div></a>";
		}
	}else{
		$project = "No projects available";
	}


?>
<!DOCTYPE html>
<html>
	<?=documentHead("Home")?>
	<body>
		<?=menuHeader(1)?>
		<div id='content'>
			<?=$project?>
		</div>
	</body>

</html>