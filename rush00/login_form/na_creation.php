<?php
	if ($_POST["login"] == FALSE || $_POST["passwd"] == FALSE || $_POST["passwd2"] == FALSE ||
	$_POST["submit"] != "OK" || $_POST["passwd"] != $_POST["passwd2"]) {
		header('Location: create.php?loginErr=1');
		exit("ERROR\n");
	}
	// Берём данные о БД из shopdb.csv
	$cont = file_get_contents('../shopdb.csv');
	if (!$cont) {
		header('Location: /rush00/setup.html');
	}
	$cont = explode(':', $cont);

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

	//Выкачиваем юзеров
	$users = array();
	if ($result = mysqli_query($conn, 'SELECT * FROM users')) {
		while ($tmp = mysqli_fetch_assoc($result)) {
			$users[] = $tmp;
		}
		mysqli_free_result($result);
	}

	$login = $_POST["login"];
	$password = hash('whirlpool', $_POST["passwd"]);

	foreach ($users as $val) {
		if ($val['username'] == $login && $val['password'] == $passwd) {
			mysqli_close($conn);
			header('Location: create.php?loginErr=1');
			exit("ERROR\n");
		}
	}

	// $sql = "INSERT INTO users (username, password, isadmin)
	// VALUES ('$login', '$password', false)";

	$sql = "CREATE USER \'admin\'@\'localhost\'
	IDENTIFIED VIA mysql_native_password USING \'***\'GRANT ALL PRIVILEGES ON *.*
	TO \'admin\'@\'localhost\' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0
	MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0CREATE DATABASE IF NOT EXISTS `admin`GRANT
	ALL PRIVILEGES ON `admin`.* TO \'admin\'@\'localhost\'";
	if (!mysqli_query($conn, $sql)) {
		mysqli_close($conn);
		header('Location: create.php?loginErr=1');
		exit("Error adding user: " . mysqli_error($conn));
	}

	header('Location: /rush00/index.php');
	mysqli_close($conn);
?>