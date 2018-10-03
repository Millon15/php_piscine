#!/usr/bin/php
<?php
	$expoded = explode(" ", $argv[1]);
	$res = array_filter($expoded);
	for ($i = 2; $i < $argc; $i++)
	{
		$expoded = explode(" ", $argv[$i]);
		$filtered = array_filter($expoded);
		foreach($filtered as $val) {
			array_push($res, $val);
		} 
	}
	sort($res, SORT_STRING);
	foreach($res as $val) {
		echo $val."\n";
	}
?>
