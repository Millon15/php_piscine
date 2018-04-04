#!/usr/bin/php
<?php
	if ($argc != 2) {
		echo "Incorrect Parameters\n";
		exit(1);
	}

	$res = trim($argv[1]);
	echo $res."\n";
	if (preg_match("/^([0-9],\/,%,*,+,-})+/", $res) === 1) {
		echo "Syntax Error\n";
		exit(1);
	}

?>