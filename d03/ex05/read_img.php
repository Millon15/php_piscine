<?php
	header("HTTP/1.1 200 OK");
	header("Date: Tue, 26 Mar 2013 09:42:42 GMT");
	header("Server: Apache");
	header("X-Powered-By: PHP/5.4.26");
	header('Content-Type: image/png');

	header('Content-Disposition: attachment; filename="42.png"');
	readfile('../img/42.png');
?>