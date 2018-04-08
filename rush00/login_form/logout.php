<?php
	session_start();
	$_SESSION['loggued_on_user'] = '';
	header('Location: /rush00/index.php');
?>