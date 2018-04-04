#!/usr/bin/php
<?php
	$expoded = explode(" ", $argv[1]);
	$filtered = array_filter($expoded);
	if (($first = reset($filtered))) {
		unset($filtered[0]);
		echo implode(" ", $filtered)." ";
		echo $first."\n";
	}
?>