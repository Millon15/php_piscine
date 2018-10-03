#!/usr/bin/php
<?php
	if ($argc < 3) {
		exit (1);
	}
	$end = array();
	foreach ($argv as $val) {
		preg_match("/[^:]+:[^:]+/", $val, $maches);
		if ($maches[0] != "") {
			preg_match("/^[^:]+/", $maches[0], $key);
			preg_match("/[^:]+$/", $maches[0], $value);
			$end["$key[0]"] = $value[0];
		}
	}
	if ($end[$argv[1]] != "")
		echo $end[$argv[1]]."\n";
	else
		exit (2);
?>
