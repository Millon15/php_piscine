<?php
	if (!$_POST['id']) {
		exit(1);
	}
	$file = 'list.csv';
	file_put_contents($file, preg_replace("/" . $_POST['id'] . ".+/", '', file_get_contents($file)));
?>