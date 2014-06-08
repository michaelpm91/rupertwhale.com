<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		header("Location: admin.php?loc=editabout");
		die();
	}
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
		<script src='//tinymce.cachefly.net/4.0/tinymce.min.js'></script>
		<script>
        	tinymce.init({
        		selector: 'textarea',
        	});

			$( document ).ready(function() {
			 
				$('#updateAbout').click(function(){
					$.ajax({
						type: 'POST',
						url: 'updateabout',
						dataType: 'text',
						data: {
							'action': 'updateAbout',
							'editData': tinyMCE.get('aboutText').getContent()

						},
						success: function(msg){
							alert('project successfully posted!');
							window.location.href = '/adminhome';

						}
					});
				});
			});
		</script>";
?>
<!DOCTYPE html>
<html>
	<?=documentHead("Edit About", $script);?>
	<body>
		<?=adminHeader()?>
		<div id='content'>
			<textarea name='aboutText'id='aboutText'><?=$aboutInfo?></textarea>
			<div style='text-align:center; margin-top:10px;'><button id='updateAbout'style='color:black; width:150px; height:30px;'>Update</button></div>
		</div>
	</body>

</html>







