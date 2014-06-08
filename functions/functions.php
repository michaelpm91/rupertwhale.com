<?php

function genString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

 function documentHead($title = '', $script='', $fancybox = false){
 	echo "	
 	<head>
		<title>Rupert Whale - $title</title>
		<link type='text/css' rel='stylesheet' href='/css/styles.css'>
		<link type='text/css' rel='stylesheet' href='/css/normalize.css'>
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>

		<script src='/scripts/respond.js'></script>";
	
	if($fancybox == true){
	echo '
		<!-- Add fancyBox -->
		<link rel="stylesheet" href="/scripts/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="/scripts/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>

		<!-- Optionally add helpers - button, thumbnail and/or media -->
		<link rel="stylesheet" href="/scripts/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
		<script type="text/javascript" src="/scripts/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<script type="text/javascript" src="/scripts/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
		
		<!-- Add Zoom helper (this is optional) -->
		<script type="text/javascript" src="/scripts/fancybox/helpers/jquery-ui-core-widget-mouse-draggable.min.js"></script>
		<script type="text/javascript" src="/scripts/fancybox/helpers/jquery.fancybox-zoom.js?v=1.0.0"></script>
		<link rel="stylesheet" type="text/css" href="/scripts/fancybox/helpers/jquery.fancybox-zoom.css?v=1.0.0" />


		<link rel="stylesheet" href="/scripts/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		<script type="text/javascript" src="/scripts/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
		<style>
			.fancybox-nav{
				width:10% !important;
			}
			.fancybox-zoom{
				z-index:10000;
			}
		</style>
		';
	}
	
	echo "$script
	</head>";
	
 }
 
 function menuHeader($curr){
 	$active1 = $active2 = '';
 	$name = '';
	 if($curr == 1){
	 	$name = "<h1 style='position: absolute; top: 15px; left: 25px;'><a style='text-decoration:none; color:white;' href='/'>Rupert Whale</a></h1>";
 		$active1 = "current";
	 }else if($curr == 2){
 		$active2 = "current";
	 }
 	echo "<div id='header'>$name<ul><li><a class='$active1' href='/'>Work</a></li><li><a class='$active2' href='/about'>About</a></li></ul></div>";
 }

 function adminHeader(){
	echo "<div id='header'><ul style='left:0 !important;'><li><a href='/adminhome'>Admin Home</a></li></ul></div>";

 }