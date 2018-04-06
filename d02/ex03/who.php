#!/usr/bin/php
<?php
	$fd = fopen("/var/run/utmpx", 'r');
	date_default_timezone_set("Europe/Kiev");
	while ($str = fread($fd, 0x274)) {
		$src = unpack("a256user/a4id/a32line/ipid/itype/Itime", $str);
		if ($src[type] == 7) {
			echo "$src[user]  $src[line]  ".date("M  j H:i", $src[time])."\n";
		}
	}
?>