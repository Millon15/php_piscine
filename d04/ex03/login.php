<?php
	if ($_GET["login"] == FALSE || $_GET["passwd"] == FALSE) {
		exit("ERROR\n");
	}

	require_once('auth.php');

	if (auth($_GET['login'], $_GET['passwd']) === TRUE) {
		session_start();
		$_SESSION['loggued_on_user'] = $_GET['login'];
		exit("OK\n");
	}
	exit("ERROR\n");
?>