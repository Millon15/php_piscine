#!/usr/bin/php
<?php
	$expoded = explode(" ", $argv[1]);
	$filtered = array_filter($expoded);
	$sliced = array_slice($filtered, 0);
	if (($first = reset($sliced))) {
		unset($sliced[0]);
		$str = implode(" ", $sliced);
		if ($str != "") {
			echo $str." ";
		}
		echo $first."\n";
	}
?>
