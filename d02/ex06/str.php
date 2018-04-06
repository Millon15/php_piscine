#!/usr/bin/php
<?php

	####	THIS CODE IS NOT WORKING !!!! ####

	if ($argc != 2) {
		exit (1);
	}
	if (file_exists($argv[1]) === FALSE || ($file = file_get_contents($argv[1])) === FALSE) {
		exit (2);
	}
	$expoded = explode("\n", $file);
	print_r($expoded);
	$time = 0;
	$i = 0;
	$end = array();
	$to_sort = array();
	foreach ($expoded as $val) {
		if ($val != "") {
			if (preg_match ("/.*-->.*/", $val[0]))
				$time = $val;
			if (preg_match ("/^\d/", $val[0]) === 0) {
				$end["$val"] = $time;
				$to_sort[$i] = $val;
				$i++;
			}
		}
		
	}
	print_r($end);
	print_r($to_sort);
	// echo $file.PHP_EOL;
?>