#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit (1);
	}

	if (preg_match("/^([A-Za-z][a-z]+) (\d\d?) ([A-Za-z][a-z]+) (\d\d\d\d) (\d\d):(\d\d):(\d\d)$/", $argv[1], $matches) === 0) {
		echo "Wrong Format\n";
		exit (2);
	}

	$day = strtolower($matches[1]);
	if ($day == "lundi")
		$d = 1;
	else if ($day == "mardi")
		$d = 2;
	else if ($day == "mercredi")
		$d = 3;
	else if ($day == "jeudi")
		$d = 4;
	else if ($day == "vendredi")
		$d = 5;
	else if ($day == "samedi")
		$d = 6;
	else if ($day == "dimanche")
		$d = 7;
	else {
		echo "Wrong Format\n";
		exit(3);
	}

	$month = strtolower($matches[3]);
	if ($month == "janvier")
		$mo = 1;
	else if ($month == "fevrier")
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
	else if ($month == "decembre")
		$mo = 12;
	else {
		echo "Wrong Format\n";
		exit(4);
	}

	date_default_timezone_set("Europe/Paris");
	$res = mktime($matches[5], $matches[6], $matches[7], $mo, $matches[2], $matches[4]);
	if ($res != 0)
		printf("%u\n", $res);
	else
		echo "Wrong Format\n";
?>
