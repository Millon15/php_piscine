<?php
	if ($_POST["login"] == FALSE || $_POST["oldpasswd"] == FALSE || $_POST["oldpasswd"] == FALSE || $_POST["submit"] != 'OK') {
		header('Location: login.php?loginErr=1');
		exit("ERROR\n");
	}
	$login = $_POST['login'];
	$password = hash('whirlpool', $_POST['passwd']);

	include('auth.php');

	if (auth($login, $password) === TRUE) {
		
		header('Location: ../index.php');
		exit("OK\n");
	}
	header('Location: login.php?loginErr=1');
	exit("ERROR\n");
		/*
	if ($_POST["login"] == FALSE || $_POST["passwd"] == FALSE || $_POST["submit"] != 'OK') {
			header('Location: login.php?loginErr=1');
			exit("ERROR\n");
		}
		$login = $_POST['login'];
		$password = hash('whirlpool', $_POST['passwd']);
		$ses = $_POST['login'];
	}

	// include('logout.php');
	include('auth.php');

	if (auth($login, $password) === TRUE) {
		$_SESSION['loggued_on_user'] = $ses;
		header('Location: ../index.php');
		exit("OK\n");
	}
	header('Location: login.php?loginErr=1');
	exit("ERROR\n");
	*/
?>