#!/usr/bin/php
<?php
	if ($argc != 2) {
		echo "Wrong Format\n";
		exit (1);
	}

	if (preg_match("//", $argv[1], $matches) === 0) {
		echo "Wrong Format\n";
		exit (2);
	}
?>