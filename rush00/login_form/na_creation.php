<?php
	if ($_POST["login"] == FALSE || $_POST["passwd"] == FALSE || $_POST["passwd2"] == FALSE ||
	$_POST["submit"] != "OK" || $_POST["passwd"] != $_POST["passwd2"]) {
		header('Location: create.php?loginErr=1');
		exit("ERROR\n");
	}

	$cont = file_get_contents('../shopdb.csv');
	if (!$cont) {
		header('Location: /rush00/setup.html');
	}
	$cont = explode(':', $cont);

	$conn = mysqli_connect("localhost", $cont[0], $cont[1], $cont[2]);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

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

	$sql = "INSERT INTO users (username, password, isadmin)
		VALUES ('$login', '$password', false)";
	if (!mysqli_query($conn, $sql)) {
		die("Error ADDING USER: " . mysqli_error($conn));
	}
	header('Location: /rush00/index.php');
	mysqli_close($conn);
?>