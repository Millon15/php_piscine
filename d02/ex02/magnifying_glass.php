#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit (1);
	}
	if (($file = file_get_contents($argv[1]))) {
		preg_match_all("/(<a.*title=)(\".*\")(.*>.*<\/a>)/", $file, $mat);
		print_r($mat);
		$i = 0;
		foreach ($mat[0] as $val) {
			$upp = $mat[1][$i].strtoupper($mat[2][$i]).$mat[3][$i];
			$file = str_replace($mat[1][$i].$mat[2][$i].$mat[3][$i], $upp, $file);
			$i++;
		}
		echo $file;
	}
?>