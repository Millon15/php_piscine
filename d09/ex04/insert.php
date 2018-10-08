<?php
	if (!$_POST['name']) {
		exit(1);
	}
	$fp = fopen('list.csv', 'a');
	$i = false;
	
	if (!$fp) {
		exit(2);
	}
	$_POST['id'] = uniqid();
	if (!fputcsv($fp, $_POST)) {
		$i = true;
	}
	fclose($fp);
	if ($i) {
		exit(3);
	}
	echo $_POST['id'];
?>