<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		header("Location: admin.php?loc=adminhome");
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';

?>

<!DOCTYPE html>
<html>
	<?=documentHead("Admin Home")?>
	<body>
		<?=adminHeader()?>
		<div id='content'>
			<ul style='font-size:25px;'>
				<li><a href='newproject'>New Project</a></li>
				<li><a href='editlistproject'>Edit Existing Project</a></li>
				<li><a href='arrangeproject'>Rearrange Home Page</a></li>
				<li><a href='editabout'>Edit About</a></li>
			</ul>
		</div>
	</body>

</html>