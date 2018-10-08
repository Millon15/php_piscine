<?php
	session_start();
	if ($_GET["submit"] == "OK" && $_GET["login"] != false && $_GET["passwd"] != false) {
		$_SESSION["login"] = $_GET["login"];
		$_SESSION["passwd"] = $_GET["passwd"];
	}
?>
<html><body>
<form>
Username: <input type="text" name="login" value="<?php echo $_SESSION["login"]; ?>" />
<br />
Password: <input type="text" name="passwd" value="<?php echo $_SESSION["passwd"]; ?>" />
<input type="submit" name="submit" value="OK" />
</form>
</body></html>