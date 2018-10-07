<?php
	function auth($login, $password)
	{
		require_once('paths.php');
		$file = file_get_contents($pass_path);
		if ( $file === false ) {
			return false;
		}

		$file = unserialize($file);
		$hashed = hash('whirlpool', $password);
		foreach ($file as $val) {
			if ( $val['login'] == $login && $val['passwd'] == $hashed ) {
				return true;
			}
		}
		return false;
	}
?>
