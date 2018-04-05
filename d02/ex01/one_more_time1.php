#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit (1);
	}

	if (preg_match("/^([A-Za-z][a-z]+) (\d\d?) ([A-Za-z][a-z]+) (\d\d\d\d) (\d\d:\d\d:\d\d)$/", $argv[1], $matches) === 0) {
		echo "Wrong Format\n";
		exit (2);
	}

	$day = strtolower($matches[1]);
	if ($day == "lundi")
		$eng_day = "Monday";
	else if ($day == "mardi")
		$eng_day = "Tuestday";
	else if ($day == "mercredi")
		$eng_day = "Wednesday";
	else if ($day == "jeudi")
		$eng_day = "Thursday";
	else if ($day == "vendredi")
		$eng_day = "Friday";
	else if ($day == "samedi")
		$eng_day = "Saturday";
	else if ($day == "dimanche")
		$eng_day = "Sunday";

	$month = strtolower($matches[3]);
	if ($month == "janvier")
		$eng_month = "January";
	else if ($month == "février")
		$eng_month = "February";
	else if ($month == "mars")
		$eng_month = "March";
	else if ($month == "avril")
		$eng_month = "April";
	else if ($month == "mai")
		$eng_month = "May";
	else if ($month == "juin")
		$eng_month = "June";
	else if ($month == "juillet")
		$eng_month = "July";
	else if ($month == "aout")
		$eng_month = "August";
	else if ($month == "septembre")
		$eng_month = "September";
	else if ($month == "octobre")
		$eng_month = "October";
	else if ($month == "novembre")
		$eng_month = "November";
	else if ($month == "décembre")
		$eng_month = "December";

	date_default_timezone_set("Europe/Paris");
	print_r($matches);
	$end_str = $eng_day." ".$matches[2]." ".$eng_month." ".$matches[4]." ".$matches[5];
	echo $end_str."\n";
	printf("ENG :: %u\n", strtotime($matches[0]));
	$french_time = strtotime($end_str);
	echo $french_time."\n";
	if ($french_time != 0)
		printf("%u\n", $french_time);
	else
		echo "Wrong Format\n";
?>