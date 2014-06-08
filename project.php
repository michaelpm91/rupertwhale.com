<?php
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';

	$db = db_con('pdo','rupertwhale');
	//SELECT project, location FROM images GROUP BY LOWER(project)
	
	/*$stmt = $db->prepare("SELECT * FROM images INNER JOIN projects ON images.projectid = projects.projectid WHERE projects.projectid = :value");
	$stmt->bindParam(':value', $_GET['id']);
	$stmt->execute();
	$result = $stmt->fetchAll();
	//print_r($result);
	$project = '';
	if (!empty($result)){
		foreach($result as $item){
			//$project .= "<a href='project/".$item['projectid']."'><div class='project'><img src='".$item['thumbnail']."'/><h3>".$item['project_title']."</h3></div></a>";
			//$project .= "<div class='project'><div class='imageContainer'><span><img src='".$item['location']."'/></span></div><h3>".$item['project']."</h3></div>";
			//<a class="fancybox" rel="group" href="big_image_1.jpg"><img src="small_image_1.jpg" alt="" /></a>
			//<a class="fancybox" rel="group" href="big_image_2.jpg"><img src="small_image_2.jpg" alt="" /></a>	
			$project .= "<a class='fancybox' rel='group' href='/".$item['location']."'><div class='project'><img src='/".$item['thumbnail']."'/></div></a>";
		}
	}else{
		$project = "No projects available";
	}*/
	$stmt = $db->prepare("SELECT * FROM project WHERE id = :value");
	$stmt->bindParam(':value', $_GET['id']);
	$stmt->execute();
	$result = $stmt->fetch();
	$project = '';
	$projectTitle = $result['title'];
	if (!empty($result)){
		$imageArray = json_decode($result['imageData'],true);
		foreach($imageArray as $index => $value){
			$project .= "<a class='fancybox' rel='group' href='/uploads/".$value['image']."' title='".$value['description']."'><div class='project'><img src='/uploads/".$value['thumbnail']."'/></div></a>";			
		}

	}else{
		$project = "No projects available";
	}

	$script = "
	<script type='text/javascript'>
		$(document).ready(function() {
			$('.fancybox').fancybox({
				helpers : {
					title :{ type: 'inside' },
					zoom : {maxZoom: 3}
				}
			});
		});
	</script>";
?>
<!DOCTYPE html>
<html>
	<?=documentHead($projectTitle,$script, true);?>
	<body>
		<?=menuHeader(1)?>
		<div id='content'>
			<h1 style='text-align:center;'><?=$projectTitle?></h1>
			<?=$project?>
		</div>
	</body>

</html>