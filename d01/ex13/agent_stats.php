#!/usr/bin/php
<?php
	if ($argc != 2 || fgets(STDIN) === false) {
		exit (1);
	}

	$uservals = array();
	$moulvals = array();
	$iuvals = array();
	$imvals = array();

	function add_field(&$array, $key, $val, &$iterator)
	{
		if (isset($array["$key"])) {
			$array["$key"] += $val;
			$iterator["$key"]++;
		}
		else {
			$array["$key"] = $val;
			$iterator["$key"] = 1;
		}
	}

	while ($line = fgets(STDIN)) {
		$matches = explode(';', $line);
		if ($matches[1] != "" && is_numeric($matches[1])) {
			if ($matches[2] == "moulinette") {
				add_field($moulvals, $matches[0], $matches[1], $imvals);
			}
			else {
				add_field($uservals, $matches[0], $matches[1], $iuvals);
			}
		}
	}

	function	average_array(&$keyvals, $iterator)
	{
		ksort($keyvals);
		foreach ($keyvals as $key => $val) {
			$keyvals["$key"] /= $iterator["$key"];
		}
	}

	if ($argv[1] === "average") {
		echo (array_sum($uservals) / array_sum($iuvals)) . PHP_EOL;
	}
	else {
		average_array($uservals, $iuvals);
		if ($argv[1] === "average_user") {
			foreach ($uservals as $key => $val) {
				echo $key . ":" . $val . PHP_EOL;
			}
		}
		else if ($argv[1] === "moulinette_variance") {
			average_array($moulvals, $imvals);
			foreach ($uservals as $key => $val) {
				$val -= (isset($moulvals["$key"])) ? $moulvals["$key"] : 0;
				echo $key . ":" . $val . PHP_EOL;
			}
		}
	}
?>
