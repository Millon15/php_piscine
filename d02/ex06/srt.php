#!/usr/bin/php
<?php
	if ($argc != 2
	|| file_exists($argv[1]) === false
	|| ($file = file_get_contents($argv[1])) === false) {
		exit (1);
	}

	$ret = preg_match_all("/(\n*\d)\n(\d\d:\d\d:\d\d,\d\d\d --> \d\d:\d\d:\d\d,\d\d\d)\n(\w*)/",
	$file, $matches, PREG_SET_ORDER);
	if ($ret == false) {
		echo ($ret === false) ? 'An error occured' : 'Wrong file format' . PHP_EOL;
		exit (2);
	}

	function cmp($a, $b)
	{
		if ($a[2] == $b[2]) { return 0; }
		return ($a[2] < $b[2]) ? -1 : 1;
	}
	usort($matches, "cmp");

	foreach ($matches as $key => $val) {
		if ($key) { echo PHP_EOL; }
		echo ($key + 1) . PHP_EOL;
		echo $val[2] . PHP_EOL;
		echo $val[3] . PHP_EOL;
	}
?>
