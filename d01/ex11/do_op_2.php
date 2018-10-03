#!/usr/bin/php
<?php
	if ($argc != 2) {
		echo "Incorrect Parameters\n";
		exit(1);
	}

	if (preg_match("/^[ \t]*([-+]?\d+)[ \t]*([\+\-\*\%\/])[ \t]*([-+]?\d+)[ \t]*$/", $argv[1], $maches) === 0) {
		echo "Syntax Error\n";
		exit(2);
	}
	$oper = $maches[2];
	$num1 = $maches[1];
	$num2 = $maches[3];
	if ($oper == "*")
		$fin = $num1 * $num2;
	else if ($oper == "/")
		$fin = $num1 / $num2;
	else if ($oper == "%")
		$fin = $num1 % $num2;
	else if ($oper == "+")
		$fin = $num1 + $num2;
	else if ($oper == "-")
		$fin = $num1 - $num2;

	echo $fin."\n";
?>
