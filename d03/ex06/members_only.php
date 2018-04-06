<?php
	if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys") {
?>
<html><body>
Hello Zaz<br />
<img src='<?php
	$file = file_get_contents('../img/42.png');
	$base64_img = base64_encode($file);
	echo "data:image/png;base64,".$base64_img;
?>'>
</body></html>
<?php
}
else {
	header("WWW-Authenticate: Basic realm=''Member area''");
	header("HTTP/1.0 401 Unauthorized");
	header("Content-Type: text/html");
?>
<html><body>That area is accessible for members only</body></html>
<?php
}
?>