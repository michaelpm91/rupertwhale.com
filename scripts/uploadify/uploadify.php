<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination


function genString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$targetFolder = '/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$fileTypes = array('jpg','JPG','jpeg','JPEG','gif','GIF','png','PNG'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);

	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

	//$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$newFileName = genString();
	$targetFile = rtrim($targetPath,'/') . '/' .$newFileName.".".$fileParts['extension'];
	$targetThumbnailFile = rtrim($targetPath,'/') . '/' .$newFileName."_thumbnail.".$fileParts['extension'];
	
	
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);

		exec("/usr/bin/convert ".$targetFile." -thumbnail 240x180^ -gravity center -extent 240x180 ".$targetThumbnailFile, $return, $value);
		///usr/bin/convert /home/kidshenlong/rupertwhale.com/img/iMuifPnKzz.PNG -thumbnail 240x180^ -gravity center -extent 240x180 /home/kidshenlong/rupertwhale.com/img/iMuifPnKzz_thumbnail.PNG
		//echo '1';
		//echo "/usr/bin/convert ".$targetfile." -thumbnail 240x180^ -gravity center -extent 240x180 ".$targetThumbnailFile;
		/*print_r($return);
		echo "<br>";
		print_r($value);
		echo "<br>";
		echo $targetThumbnailFile;
		echo "<br>";*/
		header('Content-type: application/json');
		echo json_encode(array("orig" => $newFileName.".".$fileParts['extension'], "thumb"=>$newFileName."_thumbnail.".$fileParts['extension']));
		//echo $newFileName."_thumbnail.".$fileParts['extension'];
	} else {
		header('Content-type: application/json');
		echo json_encode(array("error" => 'Invalid file type.'));
	}
}else{
	echo "empty";
}
?>