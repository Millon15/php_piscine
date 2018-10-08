<?php
	if ($_POST["login"] == false || $_POST["oldpw"] == false || $_POST["newpw"] == false || $_POST["submit"] != "OK") {
		exit("ERROR\n");
	}

	$folder = "../private";
	$name = "passwd";

	$to_put = file_get_contents($folder."/".$name);
	if ($to_put === false) {
		exit("ERROR\n");
	}
	$to_put = unserialize($to_put);
	foreach ($to_put as $key => $val) {
		if ($val['login'] == $_POST["login"] && $val['passwd'] == hash('whirlpool', $_POST["oldpw"])) {
			$to_put[$key]['passwd'] = hash('whirlpool', $_POST["newpw"]);
			file_put_contents($folder."/".$name, serialize($to_put), FILE_APPEND);
			exit("OK\n");
		}
	}
	exit("ERROR\n");
?>