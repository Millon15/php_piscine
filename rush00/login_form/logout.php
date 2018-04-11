<?php
	session_start();
	foreach ($_SESSION as $key => $value) {
		$_SESSION[$key] = FALSE;
	}
	header('Location: ../index.php');
?>