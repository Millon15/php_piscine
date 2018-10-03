#!/usr/bin/php
<?php
	if ($argc != 4) {
		echo "Incorrect Parameters\n";
		exit(1);
	}

	$num1 = trim($argv[1]);
	$oper = trim($argv[2]);
	$num2 = trim($argv[3]);

	if ($oper == "*")
		$res = $num1 * $num2;
	else if ($oper == "/")
		$res = $num1 / $num2;
	else if ($oper == "%")
		$res = $num1 % $num2;
	else if ($oper == "+")
		$res = $num1 + $num2;
	else if ($oper == "-")
		$res = $num1 - $num2;

	echo $res."\n";
?>
