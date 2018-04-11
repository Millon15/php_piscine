<?php
	function auth($login, $passwd)
	{
		// Берём данные о БД из shopdb.csv
		$cont = file_get_contents('../shopdb.csv');
		if (!$cont) {
			header('Location: /rush00/setup.html');
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

		//Выкачиваем юзеров
		$users = array();
		if ($result = mysqli_query($conn, 'SELECT * FROM users')) {
			while ($tmp = mysqli_fetch_assoc($result)) {
				$users[] = $tmp;
			}
			mysqli_free_result($result);
		}

		foreach ($users as $val) {
			if ($val['username'] == $login && $val['password'] == $passwd) {
				mysqli_close($conn);
				return TRUE;
			}
		}
		mysqli_close($conn);
		return FALSE;
	}
?>