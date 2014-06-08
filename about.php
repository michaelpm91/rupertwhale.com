<?php
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';
	
		
	$db = db_con('pdo','rupertwhale');
	
	$stmt = $db->prepare("SELECT aboutInfo FROM user WHERE username = 'rupert'");
	$stmt->execute();
	$result = $stmt->fetch();
	$aboutInfo= '';
	if (!empty($result)){
		$aboutInfo = $result['aboutInfo'];
	}
	$script = "
	<script type='text/javascript'>
		$(document).ready(function() {
			$('#email').html('<a href=\'mailto:rupertwhale@ntlworld.com\'>rupertwhale@ntlworld.com</a>');
			//$('#email')[0].href = 'mailto:' + 'rupertwhale@ntlworld.com';
		});
	</script>
	";
	
?>
<!DOCTYPE html>
<html>
	<?=documentHead("About",$script);?>
	<body>
		<?=menuHeader(2)?>
		<div id='content'>
			<div id='name'><p class='title'>Name</p><h1>Rupert Whale</h1></div>
			<div id='information'>
				<p class='title'>Location</p>
				<p>London, U.K</p>
				<p class='title'>Email</p>
				<p id='email'>...</p>
				<p class='title'>Phone</p>
				<p>07749 897336</p>
				<p class='title'>Specialities</p>
				<p>Fine artist</p>
			</div>
			<div id='about'>
				<p class='title'>About</p>
				<?=$aboutInfo?>
			</div>
		</div>
	</body>

</html>