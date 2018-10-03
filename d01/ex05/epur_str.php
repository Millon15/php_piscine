#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit(1);
	}
	$expoded = explode(" ", $argv[1]);
	$filtered = array_filter($expoded);
	echo implode(" ", $filtered)."\n";
?>
