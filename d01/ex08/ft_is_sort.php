<?php
	function ft_is_sort($array)
	{
		$ar_buf = $array;
		sort($ar_buf);
		if ($ar_buf === $array)
			return TRUE;
		else
			return FALSE;
	}
?>