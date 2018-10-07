<?php
	if ($_POST["newpw"] == false || $_POST["oldpw"] == false || $_POST["newpw"] == false || $_POST["submit"] != "OK") {
		exit("ERROR" . PHP_EOL);
	}

	require_once('paths.php');
	$to_put = file_get_contents($pass_path);

	if ($to_put === false) {
		exit("ERROR" . PHP_EOL);
	}
	$to_put = unserialize($to_put);
	foreach ($to_put as $key => $val) {
		if ($val["login"] == $_POST["login"] && $val['passwd'] == hash('whirlpool', $_POST["oldpw"])) {
			$to_put[$key]['passwd'] = hash('whirlpool', $_POST["newpw"]);
			file_put_contents($pass_path, serialize($to_put));
			exit("OK" . PHP_EOL);
			header('Location: index.html');
		}
	}
	exit("ERROR" . PHP_EOL);
?>
