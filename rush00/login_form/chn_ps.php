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
		$conn = mysqli_connect("localhost", $cont[0], $cont[1], $cont[2]);
		$passwd = hash('whirlpool', $_POST["passwd"]);
		$sql = "UPDATE users SET `password` = '" . $passwd . "' WHERE `username` = '" . $login . "'";
		if (!mysqli_query($conn, $sql)) {
			die("Error: " . mysqli_error($conn));
		}
		else {
			mysqli_close($conn);
			header('Location: login.php');
			exit("OK\n");
		}
	}
	header('Location: change_pass.php?loginErr=2');
	exit("ERROR\n");
?>