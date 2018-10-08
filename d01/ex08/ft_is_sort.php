<?php
	function ft_is_sort($array)
	{
		$ar_buf0 = $array;
		$ar_buf1 = $array;
		sort($ar_buf0);
		rsort($ar_buf1);
		if ($ar_buf0 === $array || $ar_buf1 === $array)
			return true;
		else
			return false;
	}
?>
