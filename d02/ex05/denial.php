#!/usr/bin/php
<?php
	if ($argc != 3
	|| file_exists($argv[1]) === false
	|| ($file = file_get_contents($argv[1])) === false) {
		exit (1);
	}

	$end = array();
	$arr = explode("\n", $file);

	$i = 0;
	foreach ($arr as $val) {
		$res = explode(";", $val);
		if ($i === 0) {
			if ($argv[2] != $res[0] &&
				$argv[2] != $res[1] &&
				$argv[2] != $res[2] &&
				$argv[2] != $res[3] &&
				$argv[2] != $res[4]) {
					exit (4);
			}
		}
		else {
			$name["$res[4]"] = $res[0];
			$surname["$res[1]"] = $res[1];
			$last_name["$res[1]"] = $res[0];
			$IP["$res[1]"] = $res[3];
			$mail["$res[1]"] = $res[2];
		}
		$i++;
	}

	echo "Enter your command: ";
	while ($line = fgets(STDIN))
	{
		try {
			eval("$line");
		} catch (Throwable $t) {
			echo "PHP Parse error:  syntax error, unexpected T_STRING in [....]\n";
		}
		echo "Enter your command: ";
	}
	echo "^D\n";
?>
