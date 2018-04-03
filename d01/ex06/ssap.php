#!/usr/bin/php
<?php
	// if (argc < 1) {
	// 	exit (1);
	// }
	$res = NULL;
	foreach ($argv as $value) {
		$expoded = explode(" ", $value);
		$filtered = array_filter($expoded);
		$res = array_merge($res, $filtered);
	}
	// print_r($res);
?>