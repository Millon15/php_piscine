#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit (1);
	}

	if (preg_match("/^[A-Za-z][a-z]+ (\d\d?) ([A-Za-z][a-z]+) (\d\d\d\d) (\d\d):(\d\d):(\d\d)$/", $argv[1], $matches) === 0) {
		echo "Wrong Format\n";
		exit (2);
	}

	$month = strtolower($matches[2]);
	if ($month == "janvier")
		$mo = 1;
	else if ($month == "février")
		$mo = 2;
	else if ($month == "mars")
		$mo = 3;
	else if ($month == "avril")
		$mo = 4;
	else if ($month == "mai")
		$mo = 5;
	else if ($month == "juin")
		$mo = 6;
	else if ($month == "juillet")
		$mo = 7;
	else if ($month == "aout")
		$mo = 8;
	else if ($month == "septembre")
		$mo = 9;
	else if ($month == "octobre")
		$mo = 10;
	else if ($month == "novembre")
		$mo = 11;
	else if ($month == "décembre")
		$mo = 12;

	date_default_timezone_set("Europe/Paris");
	$res = mktime($matches[4], $matches[5], $matches[6], $mo, $matches[1], $matches[3]);
	if ($res != 0)
		printf("%u\n", $res);
	else
		echo "Wrong Format\n";
?>
