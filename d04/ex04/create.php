<?php
	if ($_POST["login"] == false || $_POST["passwd"] == false || $_POST["submit"] != "OK") {
		exit("ERROR" . PHP_EOL);
	}

	require_once('paths.php');
	$new_user = array(
		"login" => $_POST["login"],
		"passwd" => hash('whirlpool', $_POST["passwd"])
	);

	if (file_exists($folder) === false) {
		mkdir($folder, 0755, true);
	}

	if (file_exists($pass_path) === false) {
		$to_put = array();
		$to_put[] = $new_user;
		file_put_contents($pass_path, serialize($to_put));
	}
	else {
		$to_put = file_get_contents($pass_path);
		$to_put = unserialize($to_put);
		foreach ($to_put as $v) {
			foreach ($v as $key => $val)
				if ($key == 'login' && $val == $_POST['login'])
					exit("ERROR" . PHP_EOL);
		}
		$to_put[] = $new_user;
		file_put_contents($pass_path, serialize($to_put), FILE_APPEND);
	}
	header('Location: index.html');
	exit("OK" . PHP_EOL);
?>
