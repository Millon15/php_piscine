<?php
	session_start();
	if ($_SESSION['loggued_on_user'])
		echo $_SESSION['loggued_on_user'].PHP_EOL;
	else
		exit("ERROR\n");
?>