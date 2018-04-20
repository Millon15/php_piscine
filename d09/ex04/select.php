<?php
	$fp = fopen('list.csv', 'r');
	$res = array();
		
	if (!$fp) {
		exit(1);
	}
	while ($arr = fgetcsv($fp)) {
		$res["$arr[0]"] = $arr[1];
	}
	echo json_encode($res);
	fclose($fp);
?>