#!/usr/bin/php
<?php
	if ($argc < 2) {
		exit (1);
	}

	$trimmed = trim($argv[1]);
	$res = preg_replace("/\s+/", " ", $trimmed);
	echo $res."\n";
?>
