<?php
	$folder = "../private";
	if ( !file_exists($folder) ) {
		mkdir($folder, 755, true);
	}
	$pass_path = $folder . '/' . "passwd";
	file_put_contents($pass_path, '', FILE_APPEND);
	$chat_path = $folder . '/' . "chat";
	file_put_contents($chat_path, '', FILE_APPEND);
?>
