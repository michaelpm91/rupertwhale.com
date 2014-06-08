<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		header("Location: admin.php?loc=newproject");
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';


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
	<?=documentHead("New Project",$script)?>
	<body>
		<?=adminHeader()?>
		<div id='content'>
			<div><h1>Project Title: <input id='projectTitle' type='text'/> <input id='saveProject' value='Save Project' type='button'/><input type="file" name="file_upload" id="file_upload" /></h1></div>
			<div style='text-align:center;'></div>
			<!--<div id='uploadWindow'style='width:100%;height:800px; background-color:white;'></div>-->
			<ul id="sortable">

			</ul>
		</div>
	</body>

</html>