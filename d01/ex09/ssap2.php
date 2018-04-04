#!/usr/bin/php
<?php

	function sort_func($to_sort)
	{
		foreach ($to_sort as $val) {
			
		}
	}

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
	sort_func($res);
	foreach($res as $val) {
		echo $val."\n";
	}
?>