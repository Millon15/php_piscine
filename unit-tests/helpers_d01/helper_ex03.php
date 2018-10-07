#!/usr/bin/php
<?PHP
require_once($argv[1] . "ex03/ft_split.php");
unset($argv[0]);
unset($argv[1]);
foreach ($argv as $argument)
{
    print_r(ft_split($argument));
}
?>