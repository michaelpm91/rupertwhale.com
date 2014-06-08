<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		header("Location: admin.php?loc=editproject");
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';
	$db = db_con('pdo','rupertwhale');
	
	$stmt = $db->prepare("SELECT * FROM project WHERE id = :value");
	$stmt->bindParam(':value', $_GET['id']);
	$stmt->execute();
	$result = $stmt->fetch();
	$project = '';
	$projectTitle = $result['title'];
	if (!empty($result)){
		$imageArray = json_decode($result['imageData'],true);
		foreach($imageArray as $index => $value){
			//$project .= "<a class='fancybox' rel='group' href='/uploads/".$value['image']."' title='".$value['description']."'><div class='project'><img src='/uploads/".$value['thumbnail']."'/></div></a>";

			$project .= '<li id="'.genString().'" class="preview ui-state-default"><div class="descriptionText" id="'.genString().'" style="display: none;"><span>'.$value['description'].'</span></div><div id="'.genString().'" class="removeFile" style="display: none;"></div><div class="progressText" id="'.genString().'" style="display: none;"></div><img data-org="'.$value['image'].'" data-thumb="'.$value['thumbnail'].'" width="100%" height="100%" id="theImg" src="/uploads/'.$value['thumbnail'].'"></li>';
		}

	}else{
		$project = "No projects available";
	}

	$script = "
		<link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css' />
		<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js'></script>
		<script type='text/javascript' src='/scripts/uploadify/jquery.uploadify.min.js'></script>
		<link rel='stylesheet' type='text/css' href='/scripts/uploadify/uploadify.css' />
		<script type='text/javascript' src='/scripts/newproject.js.php'></script>
		<style>
			#content{ margin-top:30px;}
			h1 input{color:black;}
			.uploadify{position:absolute; top:0; left:600px;}
			.uploadify-queue{display:none;}
			.ui-state-default{border:none; background:none;}
			#sortable { overflow:auto; background-color:white; list-style-type: none; margin: 0; padding: 0; width: 800px; min-height: 500px; }
			#sortable li { position:relative; margin: 1% 1%; width: 31%; height:180px; float:left; padding:0; font-size: 4em; text-align: center; }
		</style>
	";
?>
<!DOCTYPE html>
<html>
	<?=documentHead("Edit Project - $projectTitle",$script)?>
	<body>
		<input id='projectID' type='hidden' value='<?=$_GET['id']?>'/>
		<?=adminHeader()?>
		<div id='content'>
			<div><h1>Project Title: <input id='projectTitle' value='<?=$projectTitle?>'type='text'/> <input id='updateProject' value='Update' type='button'/><input type="file" name="file_upload" id="file_upload" /></h1></div>
			<div style='text-align:center;'></div>
			<ul id="sortable">
				<?=$project?>
			</ul>
		</div>
	</body>

</html>