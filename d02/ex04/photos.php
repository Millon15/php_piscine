#!/usr/bin/php
<?php
	if ($argc != 2
	|| ($file = file_get_contents($argv[1])) === false) {
		exit (1);
	}
	preg_match_all('/<img.*src=["\']([^"]*)["\']/i', $file, $mat);
	$folder = strchr($argv[1] , '/') . PHP_EOL;
	$folder = trim($folder, "/\n");
	if (file_exists($folder) === false) {
		mkdir($folder, 0755, true);
	}
	foreach ($mat[1] as $val) {
		$name = strrchr($val, '/');
		if (strpos($val, $argv[1]) === false) {
			if ($pic = file_get_contents($argv[1] . $val) == false) { continue ; }
		}
		else {
			if ($pic = file_get_contents($val) == false) { continue ; }
		}
		file_put_contents($folder . '/' . $name, $pic);
	}
?>
