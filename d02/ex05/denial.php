#!/usr/bin/php
<?php
	if ($argc != 3) {
		exit (1);
	}
	if ($argv[2] != "pseudo" && $argv[2] != "surname") {
		exit (2);
	}
	if (file_exists($argv[1]) === FALSE) {
		exit (3);
	}

	$end = array();
	if (($file = file_get_contents($argv[1])) === FALSE) {
		exit (4);
	}
	$arr = explode("\n", $file);
	foreach ($arr as $val) {
		$res = explode(";", $val);
		$name["$res[4]"] = $res[0];
		$surname["$res[1]"] = $res[1];
		$last_name["$res[1]"] = $res[0];
		$IP["$res[1]"] = $res[3];
	}

	echo "Enter your command: ";
	while ($line = fgets(STDIN))
	{
		try {
			eval("$line");
		} catch (Throwable $t) {
			echo "PHP Parse error:  syntax error, unexpected T_STRING in [....]\n";
		}
		echo "Enter your command: ";
	}
	echo "^D\n";
?>