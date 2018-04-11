<?php
	if ($_POST["login"] == FALSE || $_POST["passwd"] == FALSE || $_POST["submit"] != "OK") {
		header('Location: create.php?loginErr=1');
		exit("ERROR\n");
	}

	$cont = file_get_contents('../shopdb.csv');
	if (!$cont) {
		header('Location: ../setup.html');
	}
	$cont = explode(';', $cont);

	$conn = mysqli_connect("localhost", $cont[0], $cont[1], $cont[2]);
	if (!$conn) {
		echo "Debug info :: ";
		print_r($cont);
		?>
		<br />You, perhaps, have changed password and/or login and/or name of your mySQL database.<br />
		Please check the shopdb.csv file in the root of your server directory.<br /><br />
		shopdb.csv file has next syntax ::    login_to_your_mysql:password_to_your_mysql:name_of_your_database_on_mysql<br /><br />
<?php
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
	$addres = $_POST["addres"];
	$email = $_POST["email"];
	
	foreach ($users as $val) {
		if ($val['username'] == $login) {
			mysqli_close($conn);
			header('Location: create.php?loginErr=2');
			exit("ERROR\n");
		}
	}

	$sql = "INSERT INTO users (username, password, isadmin, email, addres)
		VALUES ('$login', '$password', false, '$email', '$addres')";
	if (!mysqli_query($conn, $sql)) {
		mysqli_close($conn);
		header('Location: create.php?loginErr=3');
		die("Error ADDING USER: " . mysqli_error($conn));
	}
	mysqli_close($conn);
	header("Location: login.php?login=". $login. "&passwd=" . $password . "&submit=OK&get=1");
?>