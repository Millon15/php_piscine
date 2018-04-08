<?php
	if ($_GET["login"] == FALSE || $_GET["passwd"] == FALSE) {
		header('Location: /rush00/index.php?loginErr=1');
		exit("ERROR\n");
	}

	include('auth.php');

	if (auth($_GET['login'], $_GET['passwd']) === TRUE) {
		session_start();
		$_SESSION['loggued_on_user'] = $_GET['login'];
		header('Location: /rush00/index.php');
	}
	exit("ERROR\n");
?>