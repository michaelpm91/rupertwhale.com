<?php
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';

	$db = db_con('pdo','rupertwhale');
	//SELECT project, location FROM images GROUP BY LOWER(project)
	
	$stmt = $db->prepare("SELECT * FROM project ORDER BY id DESC");
	$stmt->execute();
	$result = $stmt->fetchAll();
	$project = '';
	if (!empty($result)){
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