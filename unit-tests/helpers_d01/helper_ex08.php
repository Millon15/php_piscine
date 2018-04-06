#!/usr/bin/php
<?PHP
include($argv[1] . "/ex08/ft_is_sort.php");
$tab = explode(" ", $argv[2]);
if (ft_is_sort($tab))
    echo "sorted";
else
    echo "unsorted";
?>