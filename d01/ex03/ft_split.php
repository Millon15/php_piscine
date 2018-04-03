<?php
	function ft_split($to_split)
	{
		$expoded = explode(" ", $to_split);
		$filtered = array_filter($expoded);
		sort($filtered, SORT_STRING);
		return $filtered;
	}
?>