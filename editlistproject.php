<?php
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		header("Location: admin.php?loc=editlistproject");
		die();
	}
	include_once '/home/kidshenlong/Private/login.php';
	include 'functions/functions.php';
	
	$db = db_con('pdo','rupertwhale');

	
	$stmt = $db->prepare("SELECT * FROM project ORDER BY id DESC");
	$stmt->execute();
	$result = $stmt->fetchAll();
	$project = "<ul  id='projectList'>";
	if (!empty($result)){
		foreach($result as $item){
			//$project .= "<a href='project/".$item['id']."'><div class='project'><img src='/uploads/".$item['coverImage']."'/><h3>".$item['title']."</h3></div></a>";
			$project .= "<li><a href='editproject.php?id=".$item['id']."'>".$item['title']."</a><span class='deleteItem' style='cursor: pointer; position:absolute;right:50px;' data-id='".$item['id']."'> Delete </span></li>";
		}
	}else{
		$project = "<li>No projects available</li>";
	}
	$project .= "</ul>";

	$script = '
	<style>
		#projectList li .hover{
			color:red;
		}
	</style>
	<script>
	$( document ).ready(function() {
		$("#projectList").on({
			mouseenter: function(){
				$(this).children(".deleteItem").addClass("hover");
			}, 
			mouseleave: function(){
				$(this).children(".deleteItem").removeClass("hover");
			}
		}, "li");

		$("#projectList").on({
			click: function() {
       			var r=confirm("Are you sure want to delete this project?");
				if (r==true){
					x="You pressed OK!";
					$.ajax({
						type: "POST",
						url: "deleteproject",
						dataType: "text",
						data: {
							"action": "deleteproject",
							"id": $(this).data("id")

						},
						success: function(msg){
							alert("Project successfully removed.");
							window.location.href = "/adminhome";

						}
					});
				}
    		}
		}, "li .deleteItem");
	});
	</script>';
?>

<!DOCTYPE html>
<html>
	<?=documentHead("Edit Project",$script)?>
	<body>
		<?=adminHeader()?>
		<div id='content'>
			<?=$project?>
		</div>
	</body>

</html>