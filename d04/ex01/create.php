<?php
	if ($_POST["login"] == FALSE || $_POST["passwd"] == FALSE || $_POST["submit"] != "OK") {
		exit("ERROR\n");
	}
	else {
		$new_user = array(
			"login" => $_POST["login"],
			"passwd" => hash('whirlpool', $_POST["passwd"])
		);
	}

	$folder = "../private";
	$name = "passwd";

	if (file_exists($folder) === FALSE) {
		mkdir($folder, 0755, TRUE);
	}

	if (file_exists($folder."/".$name) === FALSE) {
		$to_put = array();
		$to_put[] = $new_user;
		file_put_contents($folder."/".$name, serialize($to_put));
	}
	else {
		$to_put = file_get_contents($folder."/".$name);
		$to_put = unserialize($to_put);
		foreach ($to_put as $v) {
			foreach ($v as $key => $val)
				if ($key == 'login' && $val == $_POST['login'])
					exit("ERROR\n");
		}
		$to_put[] = $new_user;
		file_put_contents($folder."/".$name, serialize($to_put));
	}
	exit("OK\n");
?>