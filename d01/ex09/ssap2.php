#!/usr/bin/php
<?php

	function	is_letter($char)
	{
		$i = ord($char);
		if ($i >= 97 && $i <= 122)
			return true;
		else
			return false;
	}

	function	is_num($char)
	{
		$i = ord($char);
		if ($i >= 48 && $i <= 57)
			return true;
		else
			return false;
	}

	function	is_letnum($char)
	{
		if (is_letter($char) || is_num($char))
			return true;
		else
			return false;
	}

	function	is_notletnum($char)
	{
		if (!is_letter($char) && !is_num($char))
			return true;
		else
			return false;
	}

	function	ascii_sort($a, $b)
	{
		$s1 = strtolower($a);
		$s2 = strtolower($b);
		$s1_len = strlen($a);
		$s2_len = strlen($b);
		$i = 0;
		while ($i < $s1_len && $i < $s2_len) {
			if ($s1[$i] != $s2[$i]) {
				if (is_letter($s1[$i]) && is_letter($s2[$i])) {
					return ord($s1[$i]) - ord($s2[$i]);
				}
				else if (is_num($s1[$i]) && is_num($s2[$i])) {
					return ord($s1[$i]) - ord($s2[$i]);
				}
				else if (is_letter($s1[$i]) && is_num($s2[$i])) {
					return -1;
				}
				else if (is_num($s1[$i]) && is_letter($s2[$i])) {
					return 1;
				}
				else if (is_letnum($s1[$i]) && is_notletnum($s2[$i])) {
					return -1;
				}
				else if (is_notletnum($s1[$i]) && is_letnum($s2[$i])) {
					return 1;
				}
				else if (is_notletnum($s1[$i]) && is_notletnum($s2[$i])) {
					return ord($s1[$i]) - ord($s2[$i]);
				}
			}
			$i++;
		}
		return $s1_len - $s2_len;
	}

	$expoded = explode(" ", $argv[1]);
	$res = array_filter($expoded);
	for ($i = 2; $i < $argc; $i++)
	{
		$expoded = explode(" ", $argv[$i]);
		$filtered = array_filter($expoded);
		foreach($filtered as $val) {
			array_push($res, $val);
		}
	}
	usort($res, 'ascii_sort');
	foreach($res as $val) {
		echo $val."\n";
	}
?>
