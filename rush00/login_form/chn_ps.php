<?php
	if ($_POST["login"] == FALSE || $_POST["oldpasswd"] == FALSE || $_POST["passwd"] == FALSE || $_POST["newpasswd"] == FALSE || $_POST["newpasswd"] != $_POST["passwd"] || $_POST["submit"] != 'OK') {
		header('Location: change_pass.php?chaErr=1');
		exit("ERROR\n");
	}

	$login = $_POST['login'];
	$password = hash('whirlpool', $_POST["oldpasswd"]);

	include('auth.php');

	if (auth($login, $password) === TRUE) {
		$cont = file_get_contents('../shopdb.csv');
		if (!$cont) {
			header('Location: ../setup.html');
		}
		$cont = explode(';', $cont);

		// Подключаемся к mysql
		$conn = mysqli_init();
		if (!$conn) {
			// header('Location: /rush00/setup.html');
			die('mysqli_init failed');
		}
		if (!mysqli_options($conn, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT = 0")) {
			// header('Location: /rush00/setup.html');
			die('MYSQLI_INIT_COMMAND failed');
		}
		if (!mysqli_real_connect($conn,"localhost", $cont[0], $cont[1], $cont[2])) {
			// header('Location: /rush00/setup.html');
			die("mysqli_real_connect failed: " . mysqli_connect_error());
		}
		$passwd = hash('whirlpool', $_POST["newpasswd"]);
		$sql = "UPDATE users SET password = '" . $passwd . "' WHERE login = '" . $login . "'";

		if (mysqli_query($conn, $sql)) {
			header('Location: login.php');
			exit("OK\n");
		}
	}
	header('Location: change_pass.php?loginErr=2');
	exit("ERROR\n");
?>