#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit (1);
	}
	if (($file = file_get_contents($argv[1]))) {
		preg_match_all("/<img.*src=\"([^\"]*)\"/i", $file, $mat);
		print_r($mat);
		mkdir($argv[1], 0775);
		foreach ($mat[1] as $val) {
			$name = strrchr($val , '/');
			if (strpos($val, $argv[1]) !== 0)
				$pic = file_get_contents($val);
			else
				$pic = file_get_contents($argv[1].$val);
			file_put_contents($argv[1]."/".$name, $pic);
		}
		// preg_match_all("/(<a[^<]*>)([^<]*<)/", $file, $mat);
		// $i = 0;
		// foreach ($mat[0] as $val) {
		// 	$upp = $mat[1][$i].strtoupper($mat[2][$i]);
		// 	$file = str_replace($mat[1][$i].$mat[2][$i], $upp, $file);
		// 	$i++;
		// }
		// echo $file;
	}
?>