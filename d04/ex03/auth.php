<?php
	function auth($login, $passwd)
	{
		$folder = "../private";
		$name = "passwd";

		$file = file_get_contents($folder."/".$name);
		if ($file === false) {
			return false;
		}
		$file = unserialize($file);
		foreach ($file as $val) {
			if ($val['login'] == $login && $val['passwd'] == hash('whirlpool', $passwd)) {
				return true;
			}
		}
		return false;
	}
?>