<?php
	if ($_GET["login"] == FALSE || $_GET["passwd"] == FALSE || $_GET["submit"] != 'OK') {
		header('Location: /rush00/index.php?loginErr=1');
		exit("ERROR\n");
	}

	include('auth.php');

	// auth($_GET['login'], hash('whirlpool', $_GET['passwd']));
	if (auth($_GET['login'], hash('whirlpool', $_GET['passwd'])) === TRUE) {
		session_start();
		$_SESSION['loggued_on_user'] = $_GET['login'];
		header('Location: /rush00/index.php');
	}
	header('Location: /rush00/index.php?loginErr=1');
	exit("ERROR\n");
?>