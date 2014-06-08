<?php
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';
	
	if(isset($_SESSION['loggedIn'])){
		header("Location: adminhome");
		die();
	}
	
	$location = 'adminhome';
	if(isset($_GET['loc'])) $location = $_GET['loc'];
	$script = "
	<script>
		$( document ).ready(function() {	 
			$('#logIn').click(function(){
				login();
			});
			$('body').keypress(function (e) {
				if (e.which == 13) {
					login();
					return false;
				}
			});
		});
		
		function login(){
			$.ajax({
				type: 'POST',
				url: 'login',
				dataType: 'json',
				data: {
					'action': 'logIn',
					'userName': $('#loginUserName').val(),
					'password': $('#loginPassword').val()

				},
				success: function(msg){
				console.log(msg);
					if(msg.login==true){
						window.location.href = '/$location';
					}else{
						$('#feedback').show();
					}

				}
			});
		}
	</script>";

?>
<!DOCTYPE html>
<html>
	<?=documentHead("Admin Login",$script)?>
	<body>
		<div id='login' style='font-size:24px;color:black;width:300px; height:300px;'>
			<table>
				<tr><td style='padding:10px 15px;'>Username</td></tr>
				<tr><td style='padding:10px 15px;'><input id='loginUserName' type='input'/></td></tr>
				<tr><td style='padding:10px 15px;'>Password</td></tr>
				<tr><td style='padding:10px 15px;'><input id='loginPassword' style='' type='password'/></td></tr>
				<tr><td style='padding:10px 15px; text-align:center;'><input id='logIn' value='Login' style='' type='submit'/></td></tr>
				<tr><td id='feedback' style='padding:10px 15px; font-size:12px; color:red; display:none; text-align:center;'>Password/Username Incorrect</td></tr>
			</table>
		</div>
	</body>
</html>