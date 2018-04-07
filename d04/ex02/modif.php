<?php
	if ($_POST["login"] == FALSE || $_POST["oldpw"] == FALSE || $_POST["newpw"] == FALSE || $_POST["submit"] != "OK") {
		exit("ERROR\n");
	}

	$folder = "../private";
	$name = "passwd";

	$to_put = file_get_contents($folder."/".$name);
	if ($to_put === FALSE) {
		exit("ERROR\n");
	}
	$to_put = unserialize($to_put);
	foreach ($to_put as $key => $val) {
		if ($val['login'] == $_POST["login"] && $val['passwd'] == hash('whirlpool', $_POST["oldpw"])) {
			$to_put[$key]['passwd'] = hash('whirlpool', $_POST["newpw"]);
			file_put_contents($folder."/".$name, serialize($to_put));
			exit("OK\n");
		}
	}
	exit("ERROR\n");
?>