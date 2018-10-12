#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit (1);
	}


	function put_error($n)
	{
		echo "Wrong Format" . PHP_EOL;
		exit ($n);
	}
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}


	if ( preg_match("/^([A-Za-z][a-z]+) (0\d|\d\d?) ([A-Za-z][a-z]+) (\d\d\d\d) (\d\d):(\d\d):(\d\d)$/m"
	, $argv[1], $m) === false ) {
		put_error(2);
	}
	$year = $m[4];
	$month = strtolower($m[3]);
	$day = strtolower($m[1]);
	$dn = (int)$m[2];
	$hour = $m[5];
	$minute = $m[6];
	$second = $m[7];

	if ($day == 'lundi')							{ $day = 'Mon'; }
	else if ($day == 'mardi')						{ $day = 'Tue'; }
	else if ($day == 'mercredi')					{ $day = 'Wed'; }
	else if ($day == 'jeudi')						{ $day = 'Thu'; }
	else if ($day == 'vendredi')					{ $day = 'Fri'; }
	else if ($day == 'samedi')						{ $day = 'Sat'; }
	else if ($day == 'dimanche')					{ $day = 'Sun'; }
	else											{ put_error(3); }

	if ($month == 'janvier')						{ $mn = 1; $month = 'Jan'; }
	else if ($month == 'fevrier')					{ $mn = 2; $month = 'Feb'; }
	else if ($month == 'mars')						{ $mn = 3; $month = 'Mar'; }
	else if ($month == 'avril')						{ $mn = 4; $month = 'Apr'; }
	else if ($month == 'mai')						{ $mn = 5; $month = 'May'; }
	else if ($month == 'juin')						{ $mn = 6; $month = 'Jun'; }
	else if ($month == 'juillet')					{ $mn = 7; $month = 'Jul'; }
	else if ($month == 'aout')						{ $mn = 8; $month = 'Aug'; }
	else if ($month == 'septembre')					{ $mn = 9; $month = 'Sep'; }
	else if ($month == 'octobre')					{ $mn = 10; $month = 'Oct'; }
	else if ($month == 'novembre')					{ $mn = 11; $month = 'Nov'; }
	else if ($month == 'decembre')					{ $mn = 12; $month = 'Dec'; }
	else											{ put_error(4); }

	if ( ! validateDate("$day, $dn $month $year $hour:$minute:$second", 'D, j M Y H:i:s') ) {
		put_error(5);
	}

	date_default_timezone_set('Europe/Paris');
	$res = mktime($hour, $minute, $second, $mn, $dn, $year);
	if ($res > 0) {
		echo $res . PHP_EOL;
	} else											{ put_error(6); }
?>
