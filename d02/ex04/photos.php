#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit (1);
	}
	if (($file = file_get_contents($argv[1]))) {
		preg_match_all("/<img.*src=\"([^\"]*)\"/i", $file, $mat);
		$folder = strchr($argv[1] , '/').PHP_EOL;
		$folder = trim($folder, "/\n");
		if (file_exists($folder) === FALSE)
			mkdir($folder, 0755, TRUE);
		foreach ($mat[1] as $val) {
			$name = strrchr($val , '/');
			if (strpos($val, $argv[1]) === FALSE) {
				$pic = file_get_contents($argv[1].$val);
			}
			else {
				$pic = file_get_contents($val);
			}
			file_put_contents($folder."/".$name, $pic);
		}
	}
?>