<?php
	function ft_split($to_split)
	{
		$expoded = explode(" ", $to_split);
		$i = 0;
		foreach ($expoded as $val) {
			if ($val === "") {
				unset($expoded[$i]);
			}
			$i++;
		}
		sort($expoded, SORT_STRING);
		return $expoded;
	}
?>
