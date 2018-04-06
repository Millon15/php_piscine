<?php
	if ($_GET["action"] == "set") {
		if ($_GET["name"] != FALSE && [$_GET["value"]] != FALSE)
			setcookie($_GET["name"], $_GET["value"], time() + 3600);
	}
	else if ($_GET["action"] == "get") {
		if ($_GET["name"] != FALSE && $_COOKIE[$_GET["name"]] != FALSE)
			echo $_COOKIE[$_GET["name"]].PHP_EOL;
	}
	else if ($_GET["action"] == "del") {
		if ($_GET["name"] != FALSE)
			setcookie($_GET["name"], "", time() - 3600);
	}
?>