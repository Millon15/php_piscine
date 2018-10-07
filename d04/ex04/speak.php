<?php
	session_start();
	require_once('paths.php');
	$file = file_get_contents($chat_path);
	if ($file === false) {
		exit("ERROR" . PHP_EOL);
	}
	$file = unserialize($file);
?>
<!DOCTYPE html>
<html>

<head>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<script langage="javascript">top.frames['chat'].location = 'chat.php';</script> <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
</head>

<body>
</body>

</html>
