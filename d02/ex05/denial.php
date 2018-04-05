#!/usr/bin/php
<?php
	if ($argc != 3 || $argv[2] != "pseudo") {
		exit (1);
	}
	if (file_exists($argv[1]) === FALSE) {
		exit (2);
	}

	$end = array();
	if (($file = file_get_contents($argv[1])) === FALSE) {
		exit (3);
	}
	$arr = explode("\n", $file);
	foreach ($arr as $val) {
		$res = explode(";", $val);
		$name["$res[4]"] = $res[0];
	}

	echo "Enter your command: ";
	while ($line = fgets(STDIN))
	{
		eval("$line");
		echo "Enter your command: ";
	}
	echo "^D\n";
?>