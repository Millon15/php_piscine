<?php
	if ($_GET['get']) {
		$login = $_GET['login'];
		$password = $_GET['passwd'];
		$ses = $_GET['login'];
	}
	else {
		if ($_POST["login"] == FALSE || $_POST["passwd"] == FALSE || $_POST["submit"] != 'OK') {
			header("Location: login.php?loginErr=1&login=" . $_POST["login"]);
			exit("ERROR\n");
		}
		$login = $_POST['login'];
		$password = hash('whirlpool', $_POST['passwd']);
		$ses = $_POST['login'];
	}

	include('auth.php');

	if (auth($login, $password) === TRUE) {
		session_start();
		$_SESSION['loggued_on_user'] = $ses;
		header('Location: ../index.php');
		exit("OK\n");
	}
	header("Location: login.php?loginErr=1&login=" . $_POST["login"]);
	exit("ERROR\n");
?>